

<?php $__env->startSection('content'); ?>
    <div class="container-fluid py-5 bg-light">
        
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('welcomepage')); ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('shoppinguser')); ?>"><?php echo e(__('language.PRODUCTS')); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('language.DOPRODUCT')); ?></li>
            </ol>
        </nav>

        <h2 id="product-title" class="mb-4 text-primary text-center">Product Details</h2>

        
        <div id="product-details" class="row justify-content-center">
            <!-- Product info will be inserted here by Axios -->
            <div class="col-12 text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    
    <script>
        // FIX: The entire script is now correctly wrapped inside DOMContentLoaded.
        document.addEventListener('DOMContentLoaded', function() {
            // --- SETUP ---
            const productId = <?php echo e($productID); ?>;
            const csrfToken = '<?php echo e(csrf_token()); ?>';
            const productDetailsContainer = document.getElementById('product-details');

            // --- REUSABLE TOAST NOTIFICATION FUNCTION ---
            function showToast(message, type = 'success') {
                const toastContainer = document.getElementById('toast-container');
                if (!toastContainer) {
                    console.error('Toast container not found!');
                    return;
                }
                const toastId = 'toast-' + Date.now();
                const toastHeaderClass = type === 'success' ? 'bg-success' : 'bg-danger';
                const toastHeaderTitle = type.charAt(0).toUpperCase() + type.slice(1);
                const toastHTML = `
                    <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header ${toastHeaderClass} text-white">
                            <strong class="me-auto">${toastHeaderTitle}</strong>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">${message}</div>
                    </div>`;
                toastContainer.insertAdjacentHTML('beforeend', toastHTML);
                const toastElement = document.getElementById(toastId);
                const toast = new bootstrap.Toast(toastElement, { delay: 3000 });
                toast.show();
                toastElement.addEventListener('hidden.bs.toast', () => toastElement.remove());
            }

            // --- DYNAMIC CART UI UPDATE FUNCTION ---
            function updateCartUI(cart) {
                const list = document.getElementById('cart-list');
                const iconBadge = document.getElementById('cart-icon-badge');
                const totalContainer = document.getElementById('cart-total-container');
                const checkoutButton = document.querySelector('.offcanvas-body .btn-primary');

                if (!list || !totalContainer || !checkoutButton) {
                    console.error("One or more cart UI elements are missing from the DOM.");
                    return;
                }

                list.innerHTML = ''; // Always clear the list before rebuilding
                let total = 0;
                let totalItems = 0;
                const uniqueItemCount = Object.keys(cart).length;

                if (uniqueItemCount === 0) {
                    list.innerHTML = '<li class="list-group-item text-center" id="cart-empty-message">Your cart is empty.</li>';
                    totalContainer.innerHTML = '';
                    checkoutButton.classList.add('disabled');
                    if (iconBadge) iconBadge.textContent = '0';
                } else {
                    for (const id in cart) {
                        const item = cart[id];
                        const subtotal = item.price * item.quantity;
                        total += subtotal;
                        totalItems += item.quantity;
                        list.innerHTML += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="/img/products/${item.image}" alt="${item.name}" class="me-3" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;" onerror="this.src='/img/default.png';">
                                    <div>
                                        <h6 class="my-0 small">${item.name}</h6>
                                        <div class="input-group input-group-sm mt-2" style="width: 110px;">
                                            <button class="btn btn-outline-secondary change-quantity-btn" type="button" data-id="${id}" data-action="decrease">-</button>
                                            <span class="form-control text-center" style="pointer-events: none;">${item.quantity}</span>
                                            <button class="btn btn-outline-secondary change-quantity-btn" type="button" data-id="${id}" data-action="increase">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column align-items-end">
                                    <span class="text-muted mb-2 item-total-price">$${subtotal.toFixed(2)}</span>
                                    <button class="btn btn-sm btn-outline-danger remove-from-cart-btn" data-id="${id}" title="Remove item">×</button>
                                </div>
                            </li>`;
                    }
                    totalContainer.innerHTML = `<li class="list-group-item d-flex justify-content-between"><span>Total (USD)</span><strong id="cart-grand-total">$${total.toFixed(2)}</strong></li>`;
                    checkoutButton.classList.remove('disabled');
                    if (iconBadge) iconBadge.textContent = totalItems;
                }
            }
            
            // --- AJAX HELPER FUNCTION ---
            function updateCartQuantity(productId, quantity) {
                axios.post('<?php echo e(route('cart.update')); ?>', { product_id: productId, quantity: quantity, _token: csrfToken })
                    .then(response => {
                        updateCartUI(response.data.cart);
                        showToast(response.data.message);
                    })
                    .catch(error => {
                        showToast(error.response?.data?.message || 'Update failed', 'danger');
                        if (error.response?.data?.cart) {
                            updateCartUI(error.response.data.cart); // Revert UI
                        }
                    });
            }

            // --- FIX: CONSOLIDATED EVENT LISTENER USING EVENT DELEGATION ---
            // This single listener handles all clicks on the page efficiently.
            document.addEventListener('click', function(event) {
                const target = event.target;

                // LOGIC FOR +/- BUTTONS IN CART
                if (target.matches('.change-quantity-btn')) {
                    const productId = target.dataset.id;
                    const action = target.dataset.action;
                    const quantitySpan = target.parentElement.querySelector('.form-control');
                    let newQuantity = parseInt(quantitySpan.textContent);
                    if (action === 'increase') newQuantity++;
                    else if (action === 'decrease') newQuantity = Math.max(1, newQuantity - 1);
                    updateCartQuantity(productId, newQuantity);
                }
                // LOGIC FOR REMOVE BUTTON IN CART
                else if (target.matches('.remove-from-cart-btn')) {
                    const productId = target.dataset.id;
                    axios.post('<?php echo e(route('cart.remove')); ?>', { product_id: productId, _token: csrfToken })
                        .then(response => {
                            updateCartUI(response.data.cart);
                            showToast(response.data.message);
                        })
                        .catch(error => showToast('Failed to remove item.', 'danger'));
                }
                // LOGIC FOR ADD TO CART BUTTON
                else if (target.closest('.add-to-cart')) {
                    event.preventDefault();
                    const button = target.closest('.add-to-cart');
                    const container = button.closest('.card-body, .d-flex');
                    const quantityInput = container.querySelector('.quantity-input');
                    if (!quantityInput) return alert('Quantity input not found.');

                    const quantity = parseInt(quantityInput.value);
                    const max = parseInt(quantityInput.max);
                    if (isNaN(quantity) || quantity < 1 || quantity > max) {
                        return alert(`Please enter a valid quantity (1-${max}).`);
                    }

                    axios.post('<?php echo e(route('cart.add')); ?>', { product_id: button.dataset.id, quantity: quantity, _token: csrfToken })
                        .then(response => {
                            updateCartUI(response.data.cart);
                            showToast(response.data.message);
                        })
                        .catch(error => showToast(error.response?.data?.message || 'Failed to add item.', 'danger'));
                }
                // LOGIC FOR TOGGLE DESCRIPTION
                else if (target.matches('.toggle-description')) {
                    event.preventDefault();
                    const descriptionBox = target.closest('.card-body').querySelector('.description-content');
                    descriptionBox.classList.toggle('d-none');
                    target.textContent = descriptionBox.classList.contains('d-none') ? 'Show Description' : 'Hide Description';
                }
                // LOGIC FOR WISHLIST
                else if (target.closest('.wishlist-btn')) {
                    const button = target.closest('.wishlist-btn');
                    button.classList.toggle('text-danger');
                    button.title = button.classList.contains('text-danger') ? 'Remove from Wishlist' : 'Add to Wishlist';
                }
            });

            // --- INITIAL DATA FETCH AND RENDER ---
            axios.get(`/api/showoneproduct/${productId}`)
                .then(response => {
                    const product = response.data.data;
                    const imagePath = `/img/products/${product["Image URL"]}`;
                    const hasDiscount = parseFloat(product.Discount) > 0;
                    const finalPrice = parseFloat(product.Price_after_Sale).toFixed(2);
                    const originalPrice = parseFloat(product.Original_Price).toFixed(2);

                    productDetailsContainer.innerHTML = `
                        <div class="col-lg-10 col-xl-8">
                            <div class="card shadow-sm border-0">
                                <div class="row g-0">
                                    <div class="col-md-7">
                                        <div class="card-body d-flex flex-column h-100 p-4">
                                            <div>
                                                <h4 class="card-title text-primary">${product.Title_en}</h4>
                                                <p class="card-text text-muted">${product.Title_ar}</p>
                                                <div class="price-container my-3">
                                                    ${hasDiscount ? `
                                                        <span class="h4 text-success me-2">$${finalPrice}</span>
                                                        <span class="text-danger text-decoration-line-through me-2">$${originalPrice}</span>
                                                        <span class="badge bg-danger">${product.Discount}% OFF</span>
                                                    ` : `<span class="h4 text-dark">$${originalPrice}</span>`}
                                                </div>
                                                <small class="d-block text-muted mb-3">${product.Quantity} in stock</small>
                                                <a href="#" class="d-block text-primary mb-2 toggle-description">Show Description</a>
                                                <div class="description-content d-none small">
                                                    <div class="p-3 mb-2 border rounded bg-light"><p class="mb-0">${product.Description_en}</p></div>
                                                    <div class="p-3 border rounded bg-light"><p class="mb-0">${product.Description_ar}</p></div>
                                                </div>
                                            </div>
                                            <div class="mt-auto pt-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="input-group" style="width: 120px;">
                                                        <span class="input-group-text">Qty</span>
                                                        <input type="number" min="1" max="${product.Quantity}" value="1" class="form-control text-center quantity-input">
                                                    </div>
                                                    <button class="btn btn-success flex-grow-1 mx-3 add-to-cart" data-id="${product.Id}">
                                                        <i class="fas fa-cart-plus me-2"></i><?php echo e(__('language.ADDTOCART')); ?>

                                                    </button>
                                                    <button class="btn btn-lg wishlist-btn text-secondary" data-id="${product.Id}" title="Add to Wishlist">
                                                        <i class="fas fa-heart"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 d-flex align-items-center justify-content-center p-3">
                                        <img src="${imagePath}" class="img-fluid rounded" alt="${product.Title_en}" style="max-height: 350px; object-fit: cover;" onerror="this.src='/img/default.png';">
                                    </div>
                                </div>
                            </div>
                        </div>`;
                })
                .catch(error => {
                    console.error('Error loading product data:', error);
                    productDetailsContainer.innerHTML = `<div class="col-12"><div class="alert alert-danger">Could not load product data. Please try again.</div></div>`;
                });

        // FIX: The script now closes the DOMContentLoaded listener correctly, with no extra brackets.
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.userpage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ADEL\Web Developing\T-square course\laravel projects\organic\resources\views/showoneproduct.blade.php ENDPATH**/ ?>