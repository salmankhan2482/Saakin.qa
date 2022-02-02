<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <?php echo $__env->make('front.layouts.cssscripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <meta name="msvalidate.01" content="BF7297537F5BAA9011B7D901DECC0066" />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.css' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/fancybox.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/panzoom.controls.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/panzoom.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/carousel.css" />
</head>

<body>
<?php echo $__env->make('front.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make('front.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

</html><?php /**PATH C:\xampp 7.4\htdocs\saakin\resources\views/front/layouts/main.blade.php ENDPATH**/ ?>