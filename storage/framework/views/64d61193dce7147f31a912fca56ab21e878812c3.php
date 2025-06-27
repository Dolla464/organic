
<?php $__env->startSection('content'); ?>
    <div id="shopping" class="py-5 overflow-hidden">
        <div class="container-lg">
            <!-- Header with Search -->
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header d-flex flex-wrap justify-content-between mb-5 align-items-center">
                        <h2 class="section-title mb-3 mb-md-3 mx-auto"><?php echo e(__('language.PRODUCTS')); ?></h2>
                        <div class="search-box w-100 w-md-auto">
                            <div class="input-group">
                                <input type="text" id="product-search" class="form-control"
                                    placeholder="<?php echo e(__('language.SEARCHPRO')); ?>" aria-label="<?php echo e(__('Search products')); ?>">
                                <button class="btn btn-primary" type="button" id="search-button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row" id="products-container">
                <div class="col-12 text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only"><?php echo e(__('language.LOADING')); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .category-card {
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .category-card:hover {
            transform: scale(1.05);
        }

        .category-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: 0.3s ease;
        }

        .description-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(240, 238, 238, 0.6);
            color: #000000;
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 1rem;
            transition: opacity 0.3s ease;
            font-size: 1rem;
        }

        .category-card:hover .description-overlay {
            opacity: 1;
        }
    </style>


    <?php $__env->startPush('scripts'); ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Detect current language (default to English)
                const currentLang = document.documentElement.lang || 'en';

                // Fetch products from API
                fetch('http://127.0.0.1:8000/api/alldataproducts')
                    .then(response => response.json())
                    .then(data => {
                        const container = document.getElementById('products-container');

                        if (data.success && data.data && data.data.length > 0) {
                            container.innerHTML = ''; // Clear loading spinner

                            data.data.forEach(product => {
                                const title = product[`Title_${currentLang}`] || product.Title_en;
                                const title_ar = product[`Title_ar`] || product.Title_ar;
                                const hasDiscount = parseFloat(product.Discount) > 0;
                                const productBaseUrl = "<?php echo e(url('/showOneProduct')); ?>";
                                const imagePath = product['Image URL'] ? '/img/products/' + product[
                                    'Image URL'] : 'https://via.placeholder.com/300';

                                container.innerHTML += `
                                <div class="col-md-3 mb-4 product-item" 
                                     data-name="${title.toLowerCase()}"
                                     data-category="${product.Id}">
                                    <div class="card h-100 category-card">
                                        <div class="position-relative">
                                            <a href="${productBaseUrl}/${product.Id}">
                                                <img src="${imagePath}" 
                                                    class="card-img-top category-image" 
                                                    alt="${title}">
                                                <div class="description-overlay">
                                                    ${product.Description_en || 'No description available'}
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">${title}</h5>
                                            <p class="card-text text-muted">${title_ar}</p>
                                            <small class="d-block ms-auto text-muted text-end">${product.Quantity} <?php echo e(__('in stock')); ?></small>
                                            
                                            <div class="price-container mb-2">
                                                ${hasDiscount ? `
                                                <span class="text-danger"><del>$${parseFloat(product.Original_Price).toFixed(2)}</del></span>
                                                <span class="badge bg-danger ms-2">${product.Discount}% OFF</span>
                                                <span class="h5 text-success"> $${parseFloat(product.Price_after_Sale).toFixed(2)}</span>
                                                ` : `
                                                <span class="h5 text-dark">$${parseFloat(product.Original_Price).toFixed(2)}</span>
                                                 `}
                                            </div>
                                            
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                            <!-- Left: Wishlist button -->
                                                <button class="btn btn-sm wishlist-btn text-secondary" 
                                                    data-id="${product.Id}" 
                                                    title="Add to Wishlist">
                                                    <i class="fas fa-heart"></i>
                                                </button>

                                                <!-- Center: Add to Cart button -->
                                                <button class="btn btn-success btn-sm w-50 add-to-cart" 
                                                    data-id="${product.Id}">
                                                    <i class="fas fa-cart-plus"></i> <?php echo e(__('language.ADDTOCART')); ?>

                                                </button>

                                                <!-- Right: Quantity input -->
                                                <input type="number" min="1" value="1" 
                                                    class="form-control form-control-sm text-end quantity-input" 
                                                    style="width: 40px;" 
                                                    data-id="${product.Id}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            });

                            //wishlist button
                            document.addEventListener('click', function(e) {
                                const btn = e.target.closest('.wishlist-btn');
                                if (btn) {
                                    // Toggle visual classes
                                    btn.classList.toggle('text-secondary'); // Gray (off)
                                    btn.classList.toggle('text-danger'); // Red (on)

                                    // Check current state
                                    const isActive = btn.classList.contains('text-danger');

                                    // ✅ Update title attribute dynamically
                                    btn.title = isActive ? 'Remove from Wishlist' : 'Add to Wishlist';

                                    // Optional: Your backend/API call here
                                    const productId = btn.getAttribute('data-id');
                                    console.log(
                                        `Wishlist toggled: Product ID ${productId}, Active: ${isActive}`
                                        );
                                }
                            });

                            // Add search functionality
                            document.getElementById('product-search').addEventListener('input', function() {
                                const searchTerm = this.value.toLowerCase();
                                document.querySelectorAll('.product-item').forEach(item => {
                                    const productName = item.getAttribute('data-name');
                                    item.style.display = productName.includes(searchTerm) ?
                                        'block' : 'none';
                                });
                            });

                        } else {
                            container.innerHTML = `
                            <div class="col-12 text-center py-5">
                                <p class="text-muted"><?php echo e(__('No products found')); ?></p>
                            </div>
                        `;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('products-container').innerHTML = `
                        <div class="col-12 text-center py-5">
                            <p class="text-danger"><?php echo e(__('Failed to load products. Please try again later.')); ?></p>
                        </div>
                    `;
                    });
                    
            });
            
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.userpage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ADEL\Web Developing\T-square course\laravel projects\organic\resources\views/shoppinguser.blade.php ENDPATH**/ ?>