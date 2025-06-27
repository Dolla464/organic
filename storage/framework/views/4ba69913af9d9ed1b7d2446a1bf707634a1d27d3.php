

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0"><?php echo e(__('language.EDITPRODUCTS')); ?></h4>
                    </div>
                    <form action="<?php echo e(route('updateProduct', $product->pro_id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="card-body">
                            <?php echo $__env->make('products.partials.form', [
                                'product' => $product,
                                'categories' => $resultCategory,
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="card-footer text-end">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>
                                    <?php echo e(__('language.UPDATEP')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    
    <script src="<?php echo e(asset('js/input-filters.js')); ?>"></script>

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const proPhotoInput = document.getElementById('prophoto');
            const previewImage = document.getElementById('preview');

            if (proPhotoInput) {
                proPhotoInput.addEventListener('change', function(event) {
                    if (event.target.files[0]) {
                        previewImage.src = URL.createObjectURL(event.target.files[0]);
                        previewImage.classList.remove('d-none');
                    }
                });
            }
        });
    </script>

    
    
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get references to the input elements
            const originalPriceInput = document.getElementById('originalprice');
            const discountInput = document.getElementById('discount');
            const netPriceInput = document.getElementById('netprice');

            // This check prevents errors if the elements aren't on the page
            if (originalPriceInput && discountInput && netPriceInput) {
                // Define the calculation function
                function calculateNetPrice() {
                    const originalPrice = parseFloat(originalPriceInput.value) || 0;
                    const discount = parseFloat(discountInput.value) || 0;
                    let netPrice = originalPrice;

                    // Ensure discount is a valid percentage before calculating
                    if (discount > 0 && discount <= 100) {
                        netPrice = originalPrice * (1 - (discount / 100));
                    }

                    // Update the readonly net price field
                    netPriceInput.value = netPrice.toFixed(2);
                }

                // Add event listeners to trigger the calculation on any input change
                originalPriceInput.addEventListener('input', calculateNetPrice);
                discountInput.addEventListener('input', calculateNetPrice);

                // IMPORTANT: Run the calculation once on page load for edit forms
                // This will pre-fill the net price based on existing values.
                if (originalPriceInput.value) {
                    calculateNetPrice();
                }
            }
        });
    </script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ADEL\Web Developing\T-square course\laravel projects\organic\resources\views/products/edit.blade.php ENDPATH**/ ?>