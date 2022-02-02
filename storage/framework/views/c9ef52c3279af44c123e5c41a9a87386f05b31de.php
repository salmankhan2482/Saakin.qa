<?php if(Session::has('error_flash_message')): ?>
    <div class="alert alert-danger">
        <?php echo e(Session::get('error_flash_message')); ?>

    </div>
<?php endif; ?>
<?php if(Session::has('flash_message_subscribe')): ?>
    <div class="alert alert-success">
        <?php echo e(Session::get('flash_message_subscribe')); ?>

    </div>
<?php endif; ?>
<?php echo Form::open(array('url' => array('subscribe'),'name'=>'search_form','id'=>'newsletter-form','role'=>'form')); ?>

<meta name="_token" content="<?php echo csrf_token(); ?>"/>
 <input type="text" name="email" id="email_id" placeholder="Your Email address.." required>
<button type="submit"><?php echo e(trans('words.submit')); ?></button>
<?php echo Form::close(); ?>

<?php /**PATH C:\xampp 7.4\htdocs\saakin\resources\views/front/pages/include/newsletter.blade.php ENDPATH**/ ?>