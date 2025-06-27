<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 m-auto">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
    <h4 class="mb-0"> 
        <?php echo e(__('language.USERS')); ?>

        
        
        <span class="badge bg-primary rounded-pill ms-2"><?php echo e($resultUser->count()); ?></span>
    </h4>
    
    
    <a href="<?php echo e(route('createuser')); ?>" class="btn btn-sm btn-success">
        <i class="fa-solid fa-plus me-2"></i>
        <?php echo e(__('language.NEWUSER')); ?>

    </a>
</div>
                    <div class="card-body">

                        
                        <?php if(session('messagedeleteuser')): ?>
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: '<?php echo e(session('messagedeleteuser')); ?>',
                                    confirmButtonColor: '#3085d6'
                                });
                            </script>
                        <?php endif; ?>

                        
                        <?php if(session('createmessage')): ?>
                            <div id="flash-message" class="alert alert-success alert-dismissible fade show" role="alert"
                                style="position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 250px;">
                                <?php echo e(session('createmessage')); ?>

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <script>
                                // Auto-hide after 3 seconds with fade-out
                                setTimeout(function() {
                                    $('#flash-message').fadeOut('slow', function() {
                                        $(this).alert('close');
                                    });
                                }, 4000);
                            </script>
                        <?php endif; ?>

                        <div class="table-responsive">
                            
                            <table class="table table-striped table-hover table-bordered text-center align-middle">

                                
                                <thead class="table-dark">
                                    <tr>
                                        <th><?php echo e(__('language.ID')); ?></th>
                                        <th><?php echo e(__('language.NAME')); ?></th>
                                        <th><?php echo e(__('language.EMAIL')); ?></th>
                                        <th><?php echo e(__('language.OPERATION')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $resultUser; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($item->id); ?></td>
                                            <td><?php echo e($item->name); ?></td>
                                            <td><?php echo e($item->email); ?></td>
                                            <td>
                                                
                                                <div class="btn-group" role="group" aria-label="User Actions">

                                                    
                                                    <a href="<?php echo e(route('showUser', $item->id)); ?>"
                                                        class="btn btn-sm btn-success rounded" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="<?php echo e(__('language.VIEW')); ?>">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>

                                                    
                                                    <a href="<?php echo e(route('editUser', $item->id)); ?>"
                                                        class="btn btn-sm btn-primary mx-3 rounded" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="<?php echo e(__('language.EDITTOL')); ?>">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>

                                                    
                                                    <button onclick="confirmDelete(<?php echo e($item->id); ?>, 'user')"
                                                        class="btn btn-sm btn-danger rounded" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="<?php echo e(__('language.DELETE')); ?>">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>

                                                    
                                                    <form id="delete-form-<?php echo e($item->id); ?>"
                                                        action="<?php echo e(route('deleteUser', $item->id)); ?>" method="POST"
                                                        class="d-none">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ADEL\Web Developing\T-square course\laravel projects\organic\resources\views/home.blade.php ENDPATH**/ ?>