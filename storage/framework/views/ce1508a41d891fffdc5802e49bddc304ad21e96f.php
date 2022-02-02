<style>
    .nexPre {
        color: #fff;
        background-color: #009fff !important;
        border-radius: 0.3rem;
        border: 0;
        min-width: 4rem;
        height: 38px !important;
        font-size: 0.7rem !important;
        font-weight: 700;
        text-decoration: none;
    }

</style>

<ul class="pagination">
    <!-- Previous Page Link -->
    <?php
        $geet = $_GET;
        unset($geet['page']);
        $urlstring = http_build_query($geet);
    ?>
    <?php if($paginator->onFirstPage()): ?>

    <?php else: ?>
        <li>
            <a href="<?php echo e($paginator->previousPageUrl()); ?>&<?php echo e($urlstring); ?>" rel="prev" class="nexPre">
                < PREV 
            </a>
        </li>
    <?php endif; ?>

    <!-- Pagination Elements -->
    <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- "Three Dots" Separator -->
        <?php if(is_string($element)): ?>
            <li class="disabled">
                <span><?php echo e($element); ?></span>
            </li>
        <?php endif; ?>

        <!-- Array Of Links -->
        <?php if(is_array($element)): ?>
            <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($page == $paginator->currentPage()): ?>
                    <li class="active">
                        <a href="#"><?php echo e($page); ?></a>
                    </li>
                <?php else: ?>
                    <li><a href="<?php echo e($url); ?>&<?php echo e($urlstring); ?>">
                            <?php echo e($page); ?>

                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- Next Page Link -->
    <?php if($paginator->hasMorePages()): ?>
        <li>
            <a href="<?php echo e($paginator->nextPageUrl()); ?>&featured=<?php echo e(request()->get('featured')); ?>" 
                rel="next" class="nexPre">
                NEXT >
            </a>
        </li>
    <?php else: ?>

    <?php endif; ?>
</ul>
<?php /**PATH C:\xampp 7.4\htdocs\saakin\resources\views/front/pages/include/pagination.blade.php ENDPATH**/ ?>