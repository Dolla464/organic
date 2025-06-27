

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-11">
                <div class="card shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">
                            <?php echo e(__('language.DOPRODUCT')); ?>

                            
                            <span
                                class="badge bg-primary rounded-pill fs-6 ms-2 align-middle"><?php echo e($resultChoosenProduct->title); ?></span>
                        </h4>

                        
                        <a href="<?php echo e(route('products')); ?>" class="btn btn-outline-secondary" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Back to Products List">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            
                            <table class="table table-striped table-hover table-bordered text-center align-middle">
                                
                                <thead class="table-dark">
                                    <tr>
                                        <th><?php echo e(__('language.ID')); ?></th>
                                        <th><?php echo e(__('language.PROIMAGE')); ?></th>
                                        <th><?php echo e(__('language.PROTITLEEN')); ?></th>
                                        <th><?php echo e(__('language.PROTITLEAR')); ?></th>
                                        <th><?php echo e(__('language.PRODESCRIPTION')); ?></th>
                                        <th><?php echo e(__('language.ORIGINALPRICE')); ?></th>
                                        <th><?php echo e(__('language.DISCOUNT')); ?></th>
                                        <th><?php echo e(__('language.NETPRICE')); ?></th>
                                        <th><?php echo e(__('language.QUANTITY')); ?></th>
                                        <th><?php echo e(__('language.CATEGORYID')); ?></th>
                                        <th><?php echo e(__('language.UPDATEDAT')); ?></th>
                                        <th><?php echo e(__('language.OPERATION')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo e($resultChoosenProduct->pro_id); ?></td>
                                        <td>
                                            
                                            <img src="<?php echo e(asset('/img/products/' . $resultChoosenProduct->pro_img)); ?>"
                                                alt="<?php echo e($resultChoosenProduct->title); ?>" class="img-fluid rounded"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        </td>
                                        <td><?php echo e($resultChoosenProduct->pro_title_en); ?></td>
                                        <td><?php echo e($resultChoosenProduct->pro_title_ar); ?></td>
                                        
                                        <td><?php echo e(\Illuminate\Support\Str::limit($resultChoosenProduct->pro_description_en, 30, '...')); ?>

                                        </td>
                                        
                                        <td>$<?php echo e(number_format($resultChoosenProduct->original_price, 2)); ?></td>
                                        <td><?php echo e($resultChoosenProduct->discount); ?>%</td>
                                        <td>$<?php echo e(number_format($resultChoosenProduct->net_price, 2)); ?></td>
                                        <td><?php echo e($resultChoosenProduct->quantity); ?></td>
                                        
                                        <td>
                                            <?php if($resultChoosenProduct->category): ?>
                                                <a href="<?php echo e(route('showCategory', $resultChoosenProduct->category->cat_id)); ?>"
                                                    class="badge bg-info text-decoration-none">
                                                    <?php echo e($resultChoosenProduct->category->cat_title_en); ?>

                                                </a>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Not Set</span>
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td><?php echo e(\Carbon\Carbon::parse($resultChoosenProduct->updated_at)->diffForHumans()); ?>

                                        </td>
                                        <td>
                                            
                                            <div class="btn-group" role="group">
                                                <a href="<?php echo e(route('editProduct', $resultChoosenProduct->pro_id)); ?>"
                                                    class="btn btn-sm btn-primary mx-2 rounded" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <button
                                                    onclick="confirmDelete(<?php echo e($resultChoosenProduct->pro_id); ?>, 'product')"
                                                    class="btn btn-sm btn-danger rounded" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Delete">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>

                                            <form id="delete-form-<?php echo e($resultChoosenProduct->pro_id); ?>"
                                                action="<?php echo e(route('deleteProduct', $resultChoosenProduct->pro_id)); ?>"
                                                method="POST" class="d-none">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                            </form>
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

<?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ADEL\Web Developing\T-square course\laravel projects\organic\resources\views/products/show.blade.php ENDPATH**/ ?>