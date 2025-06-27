<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Organic Dashboard</title>

    <!-- Scripts -->
    
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Styles -->
    
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    <script>
        function confirmDelete(elementId, type) {
            const messages = {
                category: 'The category will be deleted.',
                product: 'The product will be deleted.',
                user: 'The user will be deleted.'
            };

            Swal.fire({
                title: 'Are you sure?',
                text: messages[type] || "This item will be deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + elementId).submit();
                }
            });
        }
    </script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo e(url('/home')); ?>">
                    <img src="<?php echo e(asset('images/logo.svg')); ?>" alt="Logo" style="height: 40px;">
                </a>

                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <?php if(auth()->guard()->guest()): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                            </li>
                            <?php if(Route::has('register')): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo e(Auth::user()->name); ?>

                                </a>

                                
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                    
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <?php echo e(LaravelLocalization::getCurrentLocaleNative()); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php $__currentLoopData = LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeCode => $properties): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a class="dropdown-item"
                                        href="<?php echo e(LaravelLocalization::getLocalizedURL($localeCode, null, [], true)); ?>">
                                        <?php echo e($properties['native']); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-1">
            <div class="container-fluid">
                <div class="row">
                    <!-- Sidebar -->
                    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-none d-md-block bg-dark sidebar collapse"
                        data-bs-theme="dark">
                        <div class="position-sticky pt-3 p-3">
                            <h3 class="text-center mb-3 text-white-50"><?php echo e(__('language.DASHBOARD')); ?></h3>
                            <hr class="text-white-50">
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2">
                                    <a class="nav-link rounded <?php echo e(request()->is(app()->getLocale() . '/home*') ? 'active bg-primary' : 'text-white'); ?>"
                                        href="<?php echo e(route('home')); ?>">
                                        <i class="fa fa-users fa-fw me-2"></i> <?php echo e(__('language.USERS')); ?>

                                    </a>
                                </li>
                                <li class="nav-item mb-2">
                                    <a class="nav-link rounded <?php echo e(request()->is(app()->getLocale() . '/categories*') ? 'active bg-primary' : 'text-white'); ?>"
                                        href="<?php echo e(route('categories')); ?>">
                                        <i class="fa fa-folder fa-fw me-2"></i> <?php echo e(__('language.CATEGORIES')); ?>

                                    </a>
                                </li>
                                <li class="nav-item mb-2">
                                    <a class="nav-link rounded <?php echo e(request()->is(app()->getLocale() . '/products*') ? 'active bg-primary' : 'text-white'); ?>"
                                        href="<?php echo e(route('products')); ?>">
                                        <i class="fa fa-box fa-fw me-2"></i> <?php echo e(__('language.PRODUCTS')); ?>

                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <!-- Main Content -->
                    
                    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                        <?php echo $__env->yieldContent('content'); ?>
                    </main>
                </div>
            </div>
        </main>
    </div>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html>
<?php /**PATH D:\ADEL\Web Developing\T-square course\laravel projects\organic\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>