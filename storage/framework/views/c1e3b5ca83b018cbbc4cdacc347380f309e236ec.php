
<div class="mb-3">
    
    <label for="name" class="form-label"><?php echo e(__('language.NAME')); ?></label>
    
    
    <input type="text" name="name" id="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
           value="<?php echo e(old('name', $user->name ?? '')); ?>" placeholder="Enter user name">

    
    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback">
            <?php echo e($message); ?>

        </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="mb-3">
    <label for="email" class="form-label"><?php echo e(__('language.EMAIL')); ?></label>
    <input type="email" name="email" id="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
           value="<?php echo e(old('email', $user->email ?? '')); ?>" placeholder="Enter user email">

    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback">
            <?php echo e($message); ?>

        </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="mb-3">
    <label for="password" class="form-label"><?php echo e(__('language.PASSWORD')); ?></label>
    
    <div class="input-group">
        <input type="password" id="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
               placeholder="Enter password">
        <span class="input-group-text" id="toggle-password" style="cursor: pointer;">
            <i class="fa-regular fa-eye"></i>
        </span>
    </div>

    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        
        <div class="text-danger small mt-1">
            <?php echo e($message); ?>

        </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="mb-3">
    <label for="confirm_password" class="form-label"><?php echo e(__('language.CONFIRMPASSWORD')); ?></label>
    <div class="input-group">
        <input type="password" id="confirm_password" name="password_confirmation" class="form-control" 
               placeholder="Re-enter password">
        <span class="input-group-text" id="toggle-confirm-password" style="cursor: pointer;">
            <i class="fa-regular fa-eye"></i>
        </span>
    </div>
    
    <small id="password-error" class="text-danger d-none mt-1">Passwords do not match</small>
</div>



<div class="mb-3">
    <label for="role" class="form-label"><?php echo e(__('language.ROLE')); ?></label>
    
    <select name="role" id="role" class="form-select <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <option value="" disabled selected><?php echo e(__('language.SELECTROLE')); ?></option>
        
        <option value="Admin" <?php echo e(strtolower(old('role', $user->role ?? '')) == 'admin' ? 'selected' : ''); ?>>Admin</option>
        <option value="User" <?php echo e(strtolower(old('role', $user->role ?? '')) == 'user' ? 'selected' : ''); ?>>User</option>
    </select>
    
    <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback">
            <?php echo e($message); ?>

        </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>



<?php
    $selectedStatus = old('status', $user->status ?? null);
?>
<div class="mb-3">
    <label for="status" class="form-label"><?php echo e(__('language.STATUS')); ?></label>
    <select name="status" id="status" class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <option value="" disabled <?php echo e(is_null($selectedStatus) ? 'selected' : ''); ?>><?php echo e(__('language.SELECTSTATUS')); ?></option>
        <option value="1" <?php echo e($selectedStatus == '1' ? 'selected' : ''); ?>>Active</option>
        <option value="0" <?php echo e($selectedStatus == '0' ? 'selected' : ''); ?>>Blocked</option>
    </select>

    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback">
            <?php echo e($message); ?>

        </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div><?php /**PATH D:\ADEL\Web Developing\T-square course\laravel projects\organic\resources\views/users/partials/form.blade.php ENDPATH**/ ?>