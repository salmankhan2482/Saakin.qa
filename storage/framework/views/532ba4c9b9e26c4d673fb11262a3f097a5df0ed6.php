
<?php $__env->startSection('type','Real Estate Directory'); ?>
<?php $__env->startSection('content'); ?>
    <style>
        #more {display: none;}
        
        .search_live img{
            max-width: 50px;
            height: 50px;
            width: 50px;
        }
           
    </style>
    <?php echo $__env->make('front.pages.include.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <div class="ajaxChange">
        <?php echo $__env->make('front.pages.include.featured_properties', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    
    <?php echo $__env->make('front.pages.include.city_guide_area', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("front.layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp 7.4\htdocs\saakin\resources\views/front/pages/index.blade.php ENDPATH**/ ?>