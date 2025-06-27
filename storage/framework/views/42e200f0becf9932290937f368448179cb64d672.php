

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="card shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">
                            <?php echo e(__('language.PRODUCTS')); ?>

                            
                            <span class="badge bg-primary rounded-pill ms-2"><?php echo e($resultProduct->count()); ?></span>
                        </h4>
                        <a href="<?php echo e(route('createproduct')); ?>" class="btn btn-sm btn-success">
                            <i class="fa-solid fa-plus me-2"></i>
                            <?php echo e(__('language.NEWPRODUCTS')); ?>

                        </a>
                    </div>
                    <div class="card-body">

                        
                        
                        
                        
                        
                        <?php if(session('success')): ?>
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: '<?php echo e(session('success')); ?>',
                                    confirmButtonColor: '#3085d6'
                                });
                            </script>
                        <?php endif; ?>

                        <div class="table-responsive">
                            
                            <table class="table table-striped table-hover table-bordered text-center align-middle">
                                
                                <thead class="table-dark">
                                    <tr>
                                        <th><?php echo e(__('language.ID')); ?></th>
                                        <th><?php echo e(__('language.PROIMAGE')); ?></th>
                                        <th><?php echo e(__('language.PROTITLEEN')); ?></th>
                                        <th><?php echo e(__('language.PRODESCRIPTION')); ?></th>
                                        <th><?php echo e(__('language.OPERATION')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $resultProduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($item->pro_id); ?></td>
                                            <td>
                                                
                                                <img src="<?php echo e(asset('/img/products/' . $item->pro_img)); ?>"
                                                     alt="<?php echo e($item->title); ?>" class="img-fluid rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                            </td>
                                            <td><?php echo e($item->title); ?></td>
                                            
                                            <td><?php echo e(\Illuminate\Support\Str::limit($item->description, 50, '...')); ?></td>
                                            <td>
                                                
                                                <div class="btn-group" role="group">
                                                    <a href="<?php echo e(route('showProduct', $item->pro_id)); ?>" class="btn btn-sm btn-success rounded"
                                                       data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </a>
                                                    <a href="<?php echo e(route('editProduct', $item->pro_id)); ?>" class="btn btn-sm btn-primary mx-2 rounded"
                                                       data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <button onclick="confirmDelete(<?php echo e($item->pro_id); ?>, 'product')" class="btn btn-sm btn-danger rounded"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </div>

                                                <form id="delete-form-<?php echo e($item->pro_id); ?>"
                                                      action="<?php echo e(route('deleteProduct', $item->pro_id)); ?>" method="POST"
                                                      class="d-none">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                </form>
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
<?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ADEL\Web Developing\T-square course\laravel projects\organic\resources\views/products/products.blade.php ENDPATH**/ ?>