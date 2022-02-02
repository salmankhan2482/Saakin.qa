<?php
// config
$link_limit = 8; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>

<?php if($paginator->lastPage() > 1): ?>
    <ul class="pagination">
        <li class="<?php echo e(($paginator->currentPage() == 1) ? ' disabled' : ''); ?>">
            <a href="<?php echo e($paginator->url(1)); ?>" style="border:none;">
                <i class="fa fa-angle-double-left"></i>
            </a>
         </li>
        <?php for($i = 1; $i <= $paginator->lastPage(); $i++): ?>
            <?php
            $half_total_links = floor($link_limit / 2);
            $from = $paginator->currentPage() - $half_total_links;
            $to = $paginator->currentPage() + $half_total_links;
            if ($paginator->currentPage() < $half_total_links) {
               $to += $half_total_links - $paginator->currentPage();
            }
            if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
            }
            ?>
            <?php if($from < $i && $i < $to): ?>
                <li class="<?php echo e(($paginator->currentPage() == $i) ? ' active' : ''); ?>">
                    <a href="<?php echo e($paginator->url($i)); ?>">
                        <?php echo e($i); ?>

                    </a>
                </li>
            <?php endif; ?>
        <?php endfor; ?>
        <li class="<?php echo e(($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : ''); ?>">
            <a href="<?php echo e($paginator->url($paginator->lastPage())); ?>" style="border:none;">
                <i class="fa fa-angle-double-right"></i>
            </a>
        </li>
    </ul>
<?php endif; ?>
 <?php /**PATH C:\xampp 7.4\htdocs\saakin\resources\views/admin/pagination.blade.php ENDPATH**/ ?>