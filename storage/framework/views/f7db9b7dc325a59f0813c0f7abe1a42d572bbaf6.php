





<div class="mb-3">
    <label for="prophoto" class="form-label"><?php echo e(__('language.CHOOSECATEGORYPHOTO')); ?></label>
    <input type="file" name="prophoto" id="prophoto" class="form-control <?php $__errorArgs = ['prophoto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*">
    <?php $__errorArgs = ['prophoto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    
    
    <img id="preview"
         src="<?php echo e(isset($product) && $product->pro_img ? asset('/img/products/' . $product->pro_img) : '#'); ?>"
         alt="Image Preview" 
         class="img-thumbnail mt-2 <?php echo e(isset($product) && $product->pro_img ? '' : 'd-none'); ?>"
         style="max-width: 150px;">
</div>


<div class="row">
    <div class="col-md-6 mb-3">
        <label for="titleEN" class="form-label"><?php echo e(__('language.PROTITLEEN')); ?></label>
        <input type="text" name="titleEN" id="titleEN" class="form-control <?php $__errorArgs = ['titleEN'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
               value="<?php echo e(old('titleEN', $product->pro_title_en ?? '')); ?>" placeholder="Enter Product Title in English" maxlength="40"
               >
        <small id="charCountTitleEN" class="form-text text-muted">0 / 40 characters</small>
        <small id="inputWarningTitleEN" class="text-danger d-none"><?php echo e(__('language.ENLETTER')); ?></small>
        <?php $__errorArgs = ['titleEN'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-md-6 mb-3">
        <label for="titleAR" class="form-label"><?php echo e(__('language.PROTITLEAR')); ?></label>
        <input type="text" name="titleAR" id="titleAR" class="form-control <?php $__errorArgs = ['titleAR'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
               value="<?php echo e(old('titleAR', $product->pro_title_ar ?? '')); ?>" placeholder="Enter Product Title in Arabic" maxlength="40"
               >
        <small id="charCountTitleAR" class="form-text text-muted">0 / 40 characters</small>
        <small id="inputWarningTitleAR" class="text-danger d-none"><?php echo e(__('language.ARLETTER')); ?></small>
        <?php $__errorArgs = ['titleAR'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>


<div class="mb-3">
    <label for="descriptionEN" class="form-label"><?php echo e(__('language.PRODESCRIPTION')); ?></label>
    <textarea name="descriptionEN" id="descriptionEN" class="form-control <?php $__errorArgs = ['descriptionEN'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" maxlength="150" rows="3"
              ><?php echo e(old('descriptionEN', $product->pro_description_en ?? '')); ?></textarea>
    <small id="charCountEN" class="form-text text-muted">0 / 150 characters</small>
    <small id="inputWarningEN" class="text-danger d-none"><?php echo e(__('language.ENLETTER')); ?></small>
    <?php $__errorArgs = ['descriptionEN'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div class="mb-3">
    <label for="descriptionAR" class="form-label"><?php echo e(__('language.PRODESCRIPTIONAR')); ?></label>
    <textarea name="descriptionAR" id="descriptionAR" class="form-control <?php $__errorArgs = ['descriptionAR'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" maxlength="150" rows="3"><?php echo e(old('descriptionAR', $product->pro_description_ar ?? '')); ?></textarea>
    <small id="charCountAR" class="form-text text-muted">0 / 150 characters</small>
    <small id="inputWarningAR" class="text-danger d-none"><?php echo e(__('language.ARLETTER')); ?></small>
    <?php $__errorArgs = ['descriptionAR'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="row">
    <div class="col-md-4 mb-3">
        <label for="originalprice" class="form-label"><?php echo e(__('language.ORIGINALPRICE')); ?></label>
        <input type="text" name="originalprice" id="originalprice" class="form-control <?php $__errorArgs = ['originalprice'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
               value="<?php echo e(old('originalprice', $product->original_price ?? '')); ?>" placeholder="e.g., 100.00">
        <small id="priceWarning" class="text-danger d-none"><?php echo e(__('language.VAILDPRICE')); ?></small>
        <?php $__errorArgs = ['originalprice'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-md-4 mb-3">
        <label for="discount" class="form-label"><?php echo e(__('language.DISCOUNT')); ?></label>
        <div class="input-group">
            <input type="text" name="discount" id="discount" class="form-control <?php $__errorArgs = ['discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   value="<?php echo e(old('discount', $product->discount ?? '')); ?>" placeholder="e.g., 15">
            <span class="input-group-text">%</span>
        </div>
        <small id="discountWarning" class="text-danger d-none"><?php echo e(__('language.DISLETTER')); ?></small>
        <?php $__errorArgs = ['discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-md-4 mb-3">
        <label for="netprice" class="form-label"><?php echo e(__('language.NETPRICE')); ?></label>
        <input type="text" name="netprice" id="netprice" class="form-control" readonly
               value="<?php echo e(old('netprice', $product->net_price ?? '')); ?>">
    </div>
</div>


<div class="row">
    <div class="col-md-6 mb-3">
        <label for="quantity" class="form-label"><?php echo e(__('language.QUANTITY')); ?></label>
        <input type="text" name="quantity" id="quantity" class="form-control <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
               value="<?php echo e(old('quantity', $product->quantity ?? '')); ?>" placeholder="e.g., 50">
        <small id="quantityWarning" class="text-danger d-none"><?php echo e(__('language.VAILDQUANTITY')); ?></small>
        <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-md-6 mb-3">
        <label for="category_id" class="form-label"><?php echo e(__('language.CATEGORYID')); ?></label>
        <select name="category_id" id="category_id" class="form-select <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <option value="" disabled selected><?php echo e(__('language.SELECTCATEGORYID')); ?></option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <option value="<?php echo e($category->cat_id); ?>"
                        <?php echo e(old('category_id', $product->category_id ?? '') == $category->cat_id ? 'selected' : ''); ?>>
                    <?php echo e($category->cat_title_en); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <div class="invalid-feedback"><?php echo e($message); ?></div>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div><?php /**PATH D:\ADEL\Web Developing\T-square course\laravel projects\organic\resources\views/products/partials/form.blade.php ENDPATH**/ ?>