<style>
    @media (max-width: 900px){
        .navbar-brand{
            display: block;
            width: 140px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            margin-left: 50px;

        }
    }
</style>

<?php if(Auth::user()->usertype=='Agency'): ?>
	<?php
	$agencyid = Auth::user()->agency_id;
		$ag = \App\Agency::where("id",$agencyid)->first();
		$image_icon = URL::asset('upload/agencies/'.$ag->image);
	?>
<?php else: ?>
	<?php
		if(!empty(Auth::user()->image_icon))
		{
			$image_icon = URL::asset('upload/members/'.Auth::user()->image_icon.'-s.jpg');
		}
		else
		{
			$image_icon = URL::asset('admin_assets/images/guy.jpg');
		}
	?>
<?php endif; ?>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle visible-xs visible-sm collapsed pull-left" id="showLeftPush">
				<i class="md md-menu"></i>
			</button>
			<a class="navbar-brand" href="<?php echo e(URL::to('admin/dashboard')); ?>">
                <?php echo e(Str::limit(getcong('site_name'), 75, '...')); ?>

            </a>
			<button type="button" class="navbar-toggle pull-right" id="showRightPush">
				<i class="md md-more-vert"></i>
			</button>
		</div>
		<div class="hidden-xs">

			<ul class="nav navbar-nav navbar-right">

				<li>
					<div class="btn-group navbar-btn">
						<a href="<?php echo e(URL::to('/')); ?>" class="btn btn-success" target="_blank">
							<i class="md md-visibility"></i> 
							<?php echo e(trans('words.view_site')); ?>

						</a>
					</div>
				</li>

				<li>
					<a href="#" class="user" id="showUserPush">
						<?php if($image_icon): ?>
                            <img src="<?php echo e($image_icon); ?>" width="40" alt="person" class="img-circle">
						<?php else: ?>
							<img src="<?php echo e(URL::asset('admin_assets/images/guy.jpg')); ?>" alt="person" class="img-circle" width="40"/>
						<?php endif; ?>
					</a>
				</li>

			</ul>
		</div>
	</div>
</nav>
<?php /**PATH C:\xampp 7.4\htdocs\saakin\resources\views/admin/topbar.blade.php ENDPATH**/ ?>