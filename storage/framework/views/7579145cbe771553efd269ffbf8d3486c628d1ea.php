

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">

                
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0"><?php echo e(__('language.EDITUSERINFO')); ?></h4>
                    </div>

                    <form id="userForm" action='<?php echo e(route('updateUser', $user->id)); ?>' method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="card-body">
                            
                            <?php echo $__env->make('users.partials.form', ['user' => $user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                        <div class="card-footer text-end">
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa-solid fa-floppy-disk me-2"></i>
                                    <?php echo e(__('language.EDITUSER')); ?>

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
            // Function to handle the toggle logic
            const setupPasswordToggle = (toggleId, passwordId) => {
                const toggleElement = document.getElementById(toggleId);
                const passwordElement = document.getElementById(passwordId);
                const icon = toggleElement.querySelector('i');

                if (toggleElement && passwordElement) {
                    toggleElement.addEventListener('click', function() {
                        // Toggle the type
                        const type = passwordElement.getAttribute('type') === 'password' ? 'text' :
                            'password';
                        passwordElement.setAttribute('type', type);

                        // Toggle the icon
                        icon.classList.toggle('fa-eye');
                        icon.classList.toggle('fa-eye-slash');
                    });
                }
            };

            // Set up both password fields
            setupPasswordToggle('toggle-password', 'password');
            setupPasswordToggle('toggle-confirm-password', 'confirm_password');
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ADEL\Web Developing\T-square course\laravel projects\organic\resources\views/users/edit.blade.php ENDPATH**/ ?>