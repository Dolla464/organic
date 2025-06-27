

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-11">
                <div class="card shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">
                            <?php echo e(__('language.DETAILSOFCATEGORY')); ?>

                            
                            <span class="badge bg-primary rounded-pill fs-6 ms-2 align-middle"><?php echo e($resultChoosenCategory->title); ?></span>
                        </h4>

                        
                        <a href=<?php echo e(route('categories')); ?> class="btn btn-outline-secondary" 
                           data-bs-toggle="tooltip" data-bs-placement="top" title="Back to Categories List">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            
                            <table class="table table-striped table-hover table-bordered text-center align-middle">
                                
                                <thead class="table-dark">
                                    <tr>
                                        <th><?php echo e(__('language.ID')); ?></th>
                                        <th><?php echo e(__('language.CATEGORYIMAGE')); ?></th>
                                        <th><?php echo e(__('language.CATEGORYTITLE_EN')); ?></th>
                                        <th><?php echo e(__('language.CATEGORYTITLE_AR')); ?></th>
                                        <th><?php echo e(__('language.CATEGORYDESCRIPTION_EN')); ?></th>
                                        <th><?php echo e(__('language.CATEGORYDESCRIPTION_AR')); ?></th>
                                        <th><?php echo e(__('language.DISCOUNT')); ?></th>
                                        <th><?php echo e(__('language.CREATEDAT')); ?></th>
                                        <th><?php echo e(__('language.UPDATEDAT')); ?></th>
                                        <th><?php echo e(__('language.OPERATION')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo e($resultChoosenCategory->cat_id); ?></td>
                                        <td>
                                            
                                            <img src="<?php echo e(asset('/img/categories/' . $resultChoosenCategory->cat_image)); ?>" 
                                                 alt="<?php echo e($resultChoosenCategory->title); ?>" class="img-fluid rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                        </td>
                                        <td><?php echo e($resultChoosenCategory->cat_title_en); ?></td>
                                        <td><?php echo e($resultChoosenCategory->cat_title_ar); ?></td>
                                        
                                        <td><?php echo e(\Illuminate\Support\Str::limit($resultChoosenCategory->cat_description_en, 30, '...')); ?></td>
                                        <td><?php echo e(\Illuminate\Support\Str::limit($resultChoosenCategory->cat_description_ar, 30, '...')); ?></td>
                                        <td><?php echo e($resultChoosenCategory->discount); ?>%</td>
                                        
                                        <td><?php echo e(\Carbon\Carbon::parse($resultChoosenCategory->created_at)->format('d M, Y')); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($resultChoosenCategory->updated_at)->diffForHumans()); ?></td>
                                        <td>
                                            
                                            <div class="btn-group" role="group">
                                                <a href="<?php echo e(route('editCategory', $resultChoosenCategory->cat_id)); ?>" class="btn btn-sm btn-primary mx-3 rounded"
                                                   data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                                <button onclick="confirmDelete(<?php echo e($resultChoosenCategory->cat_id); ?>, 'category')" class="btn btn-sm btn-danger rounded"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>

                                            <form id="delete-form-<?php echo e($resultChoosenCategory->cat_id); ?>"
                                                  action="<?php echo e(route('deleteCategory', $resultChoosenCategory->cat_id)); ?>"
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
<?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\ADEL\Web Developing\T-square course\laravel projects\organic\resources\views/categories/show.blade.php ENDPATH**/ ?>