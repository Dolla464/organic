
<?php $__env->startSection('content'); ?>
    <div id="category" class="py-5 overflow-hidden">
        <div class="container-lg">
            <!-- Header with Search -->
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header d-flex flex-wrap justify-content-between mb-5 align-items-center">
                        <h2 class="m-auto section-title mb-3 mb-md-3"><?php echo e(__('language.CATEGORIES')); ?></h2>

                        <!-- Search Box -->
                        <div class="search-box w-100 w-md-auto">
                            <div class="input-group">
                                <input type="text" id="category-search" class="form-control"
                                    placeholder="<?php echo e(__('language.SEARCHCAT')); ?>" aria-label="Search categories"
                                    aria-describedby="search-button">
                                <button class="btn btn-primary" type="button" id="search-button"
                                    aria-label="Search categories">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading Skeleton -->
            <div id="skeleton-loader" class="row">
                <div class="col-12">
                    <div class="swiper skeleton-swiper">
                        <div class="swiper-wrapper">
                            <?php for($i = 0; $i < 4; $i++): ?>
                                <div class="swiper-slide">
                                    <div class="skeleton-card text-center">
                                        <div class="skeleton-image rounded-circle mx-auto"></div>
                                        <div class="skeleton-title mt-3 mx-auto"></div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Error State -->
            <div id="error-message" class="alert alert-danger d-none mb-4" role="alert"></div>

            <!-- Empty State -->
            <div id="empty-state" class="text-center py-5 d-none">
                <i class="fas fa-search fa-3x mb-3 text-muted"></i>
                <h4 class="text-muted">No categories found</h4>
                <p class="text-muted">Try adjusting your search query</p>
            </div>

            <!-- Category Carousel -->
            <div class="row">
                <div class="col-12">
                    <div id="category-carousel" class="swiper d-none">
                        <div class="swiper-wrapper" id="swiper-wrapper"></div>
                        <div class="swiper-button-next" aria-label="Next slide"></div>
                        <div class="swiper-button-prev" aria-label="Previous slide"></div>
                        <div class="swiper-pagination pt-5 mt-5"></div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <button id="load-more" class="btn btn-outline-primary d-none">
                        <span class="spinner-border spinner-border-sm d-none" id="load-more-spinner" aria-hidden="true"></span>
                        <span id="load-more-text">Load More Categories</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .skeleton-card { padding: 15px; }
        .skeleton-image {
            width: 150px;
            height: 150px;
            background: #e0e0e0;
            animation: pulse 1.5s infinite ease-in-out;
        }
        .skeleton-title {
            width: 80px;
            height: 20px;
            background: #e0e0e0;
            animation: pulse 1.5s infinite ease-in-out;
        }
        @keyframes  pulse {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 0.3; }
        }
        .category-card:focus {
            outline: 2px solid #0d6efd;
            outline-offset: 2px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <script>
        let swiper;
        let allCategories = [];
        let currentPage = 1;
        let lastPage = 1;
        const imageBaseUrl = "<?php echo e(asset('img/categories/')); ?>/";
        const categoryBaseUrl = "<?php echo e(url('/showOneCategory')); ?>";
        let isLoading = false;

        // Create slide HTML from category data
        function createCategorySlide(category) {
            const imageUrl = category.cat_image ? 
                `${imageBaseUrl}${category.cat_image}` : 
                'https://via.placeholder.com/150';
            
            return `
                <div class="swiper-slide text-center">
                    <div class="category-card" tabindex="0">
                        <a href="${categoryBaseUrl}/${category.cat_id}">
                            <img src="${imageUrl}" alt="${category.cat_title_en || 'Category'}" 
                             class="rounded-circle mx-auto mb-2" 
                             style="width: 200px; height: 200px; object-fit: cover;">
                        </a>
                        <h5 class="m-auto category-title">${category.cat_title_en || 'Untitled'}</h5>
                        <p class="category-desc">${category.cat_title_ar || ''}</p>
                        ${category.discount ? `<span class="badge bg-success">${category.discount}% Off</span>` : ''}
                    </div>
                </div>
            `;
        }

        // Render categories to the DOM
        function renderCategories(categories) {
            const wrapper = document.getElementById('swiper-wrapper');
            const emptyState = document.getElementById('empty-state');
            const carousel = document.getElementById('category-carousel');
            
            wrapper.innerHTML = '';
            
            if (categories.length === 0) {
                emptyState.classList.remove('d-none');
                carousel.classList.add('d-none');
                return;
            }
            
            emptyState.classList.add('d-none');
            carousel.classList.remove('d-none');
            
            const fragment = document.createDocumentFragment();
            categories.forEach(cat => {
                const div = document.createElement('div');
                div.innerHTML = createCategorySlide(cat);
                fragment.appendChild(div.firstElementChild);
            });
            
            wrapper.appendChild(fragment);
            
            if (swiper) {
                setTimeout(() => swiper.update(), 50);
            }
        }

        // Load categories from API
        async function loadCategories(page = 1) {
            if (isLoading) return;
            
            isLoading = true;
            document.getElementById('error-message').classList.add('d-none');
            document.getElementById('load-more-spinner').classList.remove('d-none');
            document.getElementById('load-more-text').textContent = 'Loading...';

            try {
                const response = await axios.get('<?php echo e(url('/api/alldatacategories')); ?>?page=' + page);
                const { data, last_page } = response.data;
                
                lastPage = last_page;
                allCategories = page === 1 ? data : [...allCategories, ...data];
                
                if (page === 1) {
                    renderCategories(data);
                    
                    // Initialize swiper only on first load
                    if (!swiper) {
                        swiper = new Swiper('#category-carousel', {
                            slidesPerView: 4,
                            spaceBetween: 20,
                            pagination: { el: '.swiper-pagination', clickable: true },
                            navigation: {
                                nextEl: '.swiper-button-next',
                                prevEl: '.swiper-button-prev'
                            },
                            breakpoints: {
                                0: { slidesPerView: 1.2 },
                                576: { slidesPerView: 1.5 },
                                768: { slidesPerView: 2.5 },
                                992: { slidesPerView: 3.2 },
                                1200: { slidesPerView: 4 }
                            },
                            a11y: {
                                enabled: true,
                                prevSlideMessage: 'Previous slide',
                                nextSlideMessage: 'Next slide'
                            }
                        });
                    }
                } else {
                    data.forEach(cat => {
                        document.getElementById('swiper-wrapper')
                            .insertAdjacentHTML('beforeend', createCategorySlide(cat));
                    });
                }

                document.getElementById('skeleton-loader').classList.add('d-none');
                
                if (currentPage < lastPage) {
                    document.getElementById('load-more').classList.remove('d-none');
                } else {
                    document.getElementById('load-more').classList.add('d-none');
                }
            } catch (error) {
                console.error('Error loading categories:', error);
                document.getElementById('error-message').textContent = 
                    error.response?.data?.message || 'Failed to load categories. Please try again.';
                document.getElementById('error-message').classList.remove('d-none');
                document.getElementById('skeleton-loader').classList.add('d-none');
            } finally {
                isLoading = false;
                document.getElementById('load-more-spinner').classList.add('d-none');
                document.getElementById('load-more-text').textContent = 'Load More Categories';
            }
        }

        // Search functionality
        function handleSearch() {
            const query = document.getElementById('category-search').value.toLowerCase().trim();
            
            if (!query) {
                renderCategories(allCategories);
                return;
            }

            const filtered = allCategories.filter(cat =>
                (cat.cat_title_en || '').toLowerCase().includes(query) ||
                (cat.cat_description_en || '').toLowerCase().includes(query)
            );
            
            renderCategories(filtered);
        }

        // Debounce function for search
        function debounce(func, wait) {
            let timeout;
            return function() {
                const context = this, args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', () => {
            loadCategories();

            const debouncedSearch = debounce(handleSearch, 300);
            
            // Search event handlers
            document.getElementById('search-button').addEventListener('click', handleSearch);
            document.getElementById('category-search').addEventListener('input', debouncedSearch);
            document.getElementById('category-search').addEventListener('keyup', (e) => {
                if (e.key === 'Enter') handleSearch();
            });

            // Load more handler
            document.getElementById('load-more').addEventListener('click', () => {
                if (currentPage < lastPage && !isLoading) {
                    currentPage++;
                    loadCategories(currentPage);
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.userpage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ADEL\Web Developing\T-square course\laravel projects\organic\resources\views/categoryuser.blade.php ENDPATH**/ ?>