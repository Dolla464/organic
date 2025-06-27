

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">

                
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0"><?php echo e(__('language.EDIT')); ?></h4>
                    </div>

                    <form action="<?php echo e(route('updateCategory', $category->cat_id)); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="card-body">
                            
                            <?php echo $__env->make('categories.partials.form', ['category' => $category], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                        <div class="card-footer text-end">
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>
                                    <?php echo e(__('language.UPDATEC')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    
    <script src="<?php echo e(asset('js/input-filters.js')); ?>"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const catPhotoInput = document.getElementById('catphoto');
            const previewImage = document.getElementById('previewc');

            catPhotoInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.classList.remove('d-none'); // Show the preview
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ADEL\Web Developing\T-square course\laravel projects\organic\resources\views/categories/edit.blade.php ENDPATH**/ ?>