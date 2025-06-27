

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-9">
                <div class="card shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">
                            <?php echo e(__('language.DETAILSOFUSER')); ?>

                            
                            <span class="badge bg-primary rounded-pill fs-6 ms-2 align-middle"><?php echo e($resultChoosenUser->name); ?></span>
                        </h4>
                        
                        
                        <a href=<?php echo e(route('home')); ?> class="btn btn-outline-secondary" 
                           data-bs-toggle="tooltip" data-bs-placement="top" title="Back to Users List">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            
                            <table class="table table-striped table-hover table-bordered text-center align-middle">
                                
                                <thead class="table-dark">
                                    <tr>
                                        <th><?php echo e(__('language.ID')); ?></th>
                                        <th><?php echo e(__('language.NAME')); ?></th>
                                        <th><?php echo e(__('language.EMAIL')); ?></th>
                                        <th><?php echo e(__('language.ROLE')); ?></th>
                                        <th><?php echo e(__('language.STATUS')); ?></th>
                                        <th><?php echo e(__('language.CREATEDAT')); ?></th>
                                        <th><?php echo e(__('language.UPDATEDAT')); ?></th>
                                        <th><?php echo e(__('language.OPERATION')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo e($resultChoosenUser->id); ?></td>
                                        <td><?php echo e($resultChoosenUser->name); ?></td>
                                        <td><?php echo e($resultChoosenUser->email); ?></td>
                                        <td><?php echo e($resultChoosenUser->role); ?></td>
                                        <td>
                                            
                                            <?php if($resultChoosenUser->status == 1): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Blocked</span>
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td><?php echo e(\Carbon\Carbon::parse($resultChoosenUser->created_at)->format('d M, Y')); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($resultChoosenUser->updated_at)->diffForHumans()); ?></td>
                                        <td>
                                            
                                            <div class="btn-group" role="group">
                                                <a href="<?php echo e(route('editUser',$resultChoosenUser->id)); ?>" class="btn btn-sm btn-primary rounded"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>

                                                <button onclick="confirmDelete(<?php echo e($resultChoosenUser->id); ?>, 'user')" class="btn btn-sm btn-danger mx-3 rounded"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>

                                                <form id="delete-form-<?php echo e($resultChoosenUser->id); ?>"
                                                      action="<?php echo e(route('deleteUser', $resultChoosenUser->id)); ?>" method="POST"
                                                      class="d-none"> 
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ADEL\Web Developing\T-square course\laravel projects\organic\resources\views/users/show.blade.php ENDPATH**/ ?>