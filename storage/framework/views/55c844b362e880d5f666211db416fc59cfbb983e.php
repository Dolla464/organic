





<div class="mb-3">
    <label for="catphoto" class="form-label"><?php echo e(__('language.CHOOSECATEGORYPHOTO')); ?></label>
    <input type="file" name="catphoto" id="catphoto" class="form-control <?php $__errorArgs = ['catphoto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*">
    <?php $__errorArgs = ['catphoto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback"><?php echo e($message); ?></div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    
    
    <img id="previewc"
         src="<?php echo e(isset($category) && $category->cat_image ? asset('/img/categories/' . $category->cat_image) : '#'); ?>"
         alt="Image Preview" 
         class="img-thumbnail mt-2 <?php echo e(isset($category) && $category->cat_image ? '' : 'd-none'); ?>"
         style="max-width: 150px;">
</div>


<div class="mb-3">
    <label for="titleEN" class="form-label"><?php echo e(__('language.CATEGORYTITLE_EN')); ?></label>
    <input type="text" name="titleEN" id="titleEN"
           class="form-control <?php $__errorArgs = ['titleEN'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
           value="<?php echo e(old('titleEN', $category->cat_title_en ?? '')); ?>"
           placeholder="Enter Category Title in English" maxlength="40">
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


<div class="mb-3">
    <label for="titleAR" class="form-label"><?php echo e(__('language.CATEGORYTITLE_AR')); ?></label>
    <input type="text" name="titleAR" id="titleAR"
           class="form-control <?php $__errorArgs = ['titleAR'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
           value="<?php echo e(old('titleAR', $category->cat_title_ar ?? '')); ?>"
           placeholder="Enter Category Title in Arabic" maxlength="40">
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


<div class="mb-3">
    <label for="descriptionEN" class="form-label"><?php echo e(__('language.CATEGORYDESCRIPTION_EN')); ?></label>
    <textarea name="descriptionEN" id="descriptionEN" class="form-control <?php $__errorArgs = ['descriptionEN'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" maxlength="150" rows="3"
            ><?php echo e(old('descriptionEN', $category->cat_description_en ?? '')); ?></textarea>
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
    <label for="descriptionAR" class="form-label"><?php echo e(__('language.CATEGORYDESCRIPTION_AR')); ?></label>
    <textarea name="descriptionAR" id="descriptionAR" class="form-control <?php $__errorArgs = ['descriptionAR'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" maxlength="150" rows="3"
              ><?php echo e(old('descriptionAR', $category->cat_description_ar ?? '')); ?></textarea>
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


<div class="mb-3">
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
               value="<?php echo e(old('discount', $category->discount ?? '')); ?>" placeholder="Enter Discount Percentage">
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
</div><?php /**PATH D:\ADEL\Web Developing\T-square course\laravel projects\organic\resources\views/categories/partials/form.blade.php ENDPATH**/ ?>