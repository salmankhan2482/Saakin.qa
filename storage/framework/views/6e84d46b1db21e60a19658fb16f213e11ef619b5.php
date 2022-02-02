<header class="header transparent scroll-hide ">
    <div class="site-navbar-wrap v1 <?php if(Request::is('property/*')): ?><?php echo e('detail_nav'); ?><?php endif; ?>">
        <div class="container-fluid">
            <div class="site-navbar">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 col-6">
                        <div class="d-lg-none float-left mr-2">
                            <a href="#" class="mobile-bar js-menu-toggle">
                                <span class="lnr lnr-menu"></span>
                            </a>
                        </div>
                        <?php if(Request::is('property/*')): ?>
                            <a class="navbar-brand" href="<?php echo e(URL::to('/')); ?>">
                                <img src="<?php echo e(URL::asset('assets/images/Whitelogo.png')); ?>" alt="Saakin"
                                    class="img-fluid">
                            </a>
                        <?php else: ?>
                            <a class="navbar-brand white-logo" href="<?php echo e(URL::to('/')); ?>">
                                <img src="<?php echo e(URL::asset('upload/logo.png')); ?>" alt="Saakin" class="img-fluid">
                            </a>
                        <?php endif; ?>

                    </div>
                    <div class="col-lg-8 col-md-8 col--sm-6 col-xs-6 ml-auto col-6">
                        <div class="menu-btn text-right float-right ">
                            <ul class="user-btn v2">
                                <?php if(!Auth::user()): ?>
                                    <li><a href="#" data-toggle="modal" data-target="#user-login-popup">Login</a></li>
                                <?php else: ?>
                                    <li><a href="<?php echo e(url('logout')); ?>">Logout</a></li>
                                <?php endif; ?>
                            </ul>
                            <div class="add-list float-right ml-3">
                                <?php if(Auth::user()): ?>
                                    <?php if(Auth::user()->usertype == 'Agency'): ?>
                                        <a class="btn v6" href="<?php echo e(URL::to('admin/properties/create')); ?>">
                                            Submit Property</a>
                                    <?php elseif(Auth::user()->usertype=='Admin'): ?>
                                        <a class="btn v6" href="<?php echo e(URL::to('admin/properties/create')); ?>">
                                            Submit Property
                                        </a>
                                    <?php else: ?>
                                        <a class="btn v6" href="<?php echo e(url('submit-property')); ?>">Submit
                                            Property</a>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <a data-toggle="modal" data-target="<?php echo e('#user-login-popup'); ?>"
                                        class="btn v6" href="#">
                                        Submit Property
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <nav class="site-navigation text-right float-right">
                            <div class="container" style="padding-top: 4px !important">
                                <ul class="site-menu js-clone-nav d-none d-lg-block">

                                    <li>
                                        <a href="<?php echo e(route('property-purpose', ['buy', 'sale'])); ?>">
                                            Buy
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(route('property-purpose', ['rent', 'rent'])); ?>">
                                            Rent
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(url('city-guide')); ?>">
                                            City Guide
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(url('real-estate-agencies')); ?>">
                                            Real Estate Agencies
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(url('blogs')); ?>">
                                            Blogs
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <!--mobile-menu starts -->
                        <div class="site-mobile-menu">
                            <div class="site-mobile-menu-header">
                                <div class="site-mobile-menu-close js-menu-toggle"><span class="lnr lnr-cross"></span>
                                </div>
                                <a href="<?php echo e(URL::to('/')); ?>">
                                    <img src="<?php echo e(URL::asset('upload/' . getcong('site_favicon'))); ?>" alt="fav icon"
                                        width="45">
                                </a>
                            </div>


                            <div class="site-mobile-menu-body position-relative">
                                <?php if(!Auth::user()): ?>
                                    <a href="<?php echo e(url('login')); ?>"
                                        class="btn btn-block btn_mb_login btn-outline-secondary">Register/Sign In</a>
                                <?php else: ?>
                                    <a href="<?php echo e(url('logout')); ?>"
                                        class="btn btn-block btn_mb_login btn-outline-secondary">Logout</a>

                                <?php endif; ?>
                            </div>

                        </div>
                        <!--mobile-menu ends-->
                    </div>
                    <!--<div class="col-lg-3 col-md-4 col-4"></div>-->
                </div>
            </div>
        </div>
    </div>
</header>
<?php /**PATH C:\xampp 7.4\htdocs\saakin\resources\views/front/layouts/navbar.blade.php ENDPATH**/ ?>