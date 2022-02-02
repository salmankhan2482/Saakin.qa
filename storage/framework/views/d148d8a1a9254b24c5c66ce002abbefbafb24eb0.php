<!-- Sidebar Left -->
<div class="sidebar left-side" id="sidebar-left">
    <div class="sidebar-user">
        <div class="media sidebar-padding">
            <div class="media-left media-middle">
                <?php if(Auth::user()->usertype == 'Agency'): ?>
                    <?php
                        $agencyid = Auth::user()->agency_id;
                        $ag = \App\Agency::where('id', $agencyid)->first();
                        $image_icon = URL::asset('upload/agencies/' . $ag->image);
                    ?>
                <?php else: ?>
                    <?php
                        if (!empty(Auth::user()->image_icon)) {
                            $image_icon = URL::asset('upload/members/' . Auth::user()->image_icon . '-s.jpg');
                        }else{
                            $image_icon = URL::asset('admin_assets/images/guy.jpg');
                        }
                    ?>
                <?php endif; ?>
                <?php if($image_icon): ?>
                    <img src="<?php echo e($image_icon); ?>" width="60" alt="person" class="img-circle">
                <?php else: ?>
                    <img src="<?php echo e(URL::asset('admin_assets/images/guy.jpg')); ?>" alt="person" class="img-circle" width="60" />
                <?php endif; ?>
            </div>
            <div class="media-body media-middle">

                <a href="<?php echo e(URL::to('admin/profile')); ?>" class="h4 margin-none"><?php echo e(Auth::user()->name); ?></a>
                <ul class="list-unstyled list-inline margin-none">
                    <li>
                        <a href="<?php echo e(URL::to('admin/profile')); ?>">
                            <i class="md-person-outline"></i>
                        </a>
                    </li>
                    <?php if(Auth::User()->usertype == 'Admin'): ?>
                        <li>
                            <a href="<?php echo e(URL::to('admin/settings')); ?>">
                                <i class="md-settings"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="<?php echo e(URL::to('admin/logout')); ?>">
                            <i class="md-exit-to-app"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Wrapper Reqired by Nicescroll (start scroll from here) -->
    <div class="nicescroll">
        <div class="wrapper" style="margin-bottom:90px">
            <ul class="nav nav-sidebar" id="sidebar-menu">

                <?php if(Auth::user()->usertype == 'Admin'): ?>

                    <li class="<?php echo e(classActivePath('dashboard')); ?>">
                        <a href="<?php echo e(URL::to('admin/dashboard')); ?>">
                            <i class="fa fa-dashboard"></i> 
                            <?php echo e(trans('words.dashboard_text')); ?>

                        </a>
                    </li>

                    <li class="<?php echo e(classActivePath('scrapper')); ?>">
                        <a href="<?php echo e(URL::to('admin/scrapper')); ?>">
                            <i class="md-settings"></i> 
                            Scrapper
                        </a>
                    </li>

                    <li class="<?php echo e(classActivePath('agencies')); ?>">
                        <a href="<?php echo e(URL::to('admin/agencies')); ?>">
                            <i class="fa fa-tags"></i>
                            <?php echo e(trans('words.agencies')); ?>

                        </a>
                    </li>



                    <li class=" submenu 
                                <?php echo e(classActivePath('properties-page-content')); ?> 
                                <?php echo e(classActivePath('landing-pages')); ?>

                                <?php echo e(classActivePath('city-guide-page-content')); ?>

                                <?php echo e(classActivePath('agencies-page-content')); ?>

                                ">

                        <a href="#" 
                            <?php if(
                                classActivePath('properties-page-content') 
                                or classActivePath('landing-pages')
                                or (classActivePath('city-guide-page-content')) 
                                or classActivePath('landing-pages')
                                or classActivePath('agencies-page-content')
                                ): ?>  
                                class="open" 
                            <?php endif; ?>>

                            <i class="md md-description"></i> 
                            <?php echo e(trans('words.landing_pages')); ?>

                        </a>

                        <ul <?php if(
                                classActivePath('properties-page-content') 
                                or classActivePath('landing-pages')
                                or classActivePath('city-guide-page-content')
                                or classActivePath('agencies-page-content')
                                ): ?> 
                            style="display: block" 
                            class="collapse in" 
                            <?php endif; ?>>
                            
                            <li class="<?php echo e(classActivePath('properties-page-content')); ?>">
                                <a href="<?php echo e(URL::to('admin/properties-page-content')); ?>">
                                    <?php echo e(trans('words.properties_page_content')); ?>

                                </a>
                            </li>
                            <li class="<?php echo e(classActivePath('landing-pages')); ?>">
                                <a href="<?php echo e(URL::to('admin/landing-pages')); ?>">
                                    <?php echo e(trans('words.landing_pages_content')); ?>

                                </a>
                            </li>
                            <li class="<?php echo e(classActivePath('city-guide-page-content')); ?>">
                                <a  href="<?php echo e(URL::to('admin/city-guide-page-content')); ?>">
                                    <?php echo e(trans('words.city_guide_page_content')); ?>

                                </a>
                            </li>
                            <li class="<?php echo e(classActivePath('agencies-page-content')); ?>">
                                <a href="<?php echo e(URL::to('admin/agencies-page-content')); ?>">
                                    <?php echo e(trans('words.agencies_page_content')); ?>

                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="submenu <?php echo e(classActivePath('cities')); ?> <?php echo e(classActivePath('city-detail/list')); ?>">
                        <a href="#" <?php if(classActivePath('cities') or classActivePath('city-detail/list')): ?> class="open" <?php endif; ?>>
                            <i class="md md-description"></i> 
                            <?php echo e(trans('words.city_guides')); ?>

                        </a>
                        
                        <ul <?php if(classActivePath('cities') or classActivePath('city-detail/list')): ?> style="display: block" 
                            class="collapse in" <?php endif; ?>>
                            <li class="<?php echo e(classActivePath('cities')); ?>">
                                <a href="<?php echo e(URL::to('admin/cities')); ?>">
                                    <?php echo e(trans('words.cities')); ?>

                                </a>
                            </li>
                            
                            <li class="<?php echo e(classActivePath('city-detail/list')); ?>">
                                <a href="<?php echo e(URL::to('admin/city-detail/list')); ?>">
                                    <?php echo e(trans('words.city_details')); ?>

                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="submenu <?php echo e(classActivePath('blogs')); ?> <?php echo e(classActivePath('blog-category/list')); ?>">
                        <a href="#" <?php if(classActivePath('blogs') or classActivePath('blog-category/list')): ?> class="open" <?php endif; ?>>
                            <i class="md md-description"></i> 
                                <?php echo e(trans('words.blogs')); ?>

                        </a>
                        <ul <?php if(classActivePath('blogs') or classActivePath('blog-category/list')): ?> 
                            style="display: block" class="collapse in" <?php endif; ?>>
                            <li class="<?php echo e(classActivePath('blogs')); ?>">
                                <a href="<?php echo e(URL::to('admin/blogs')); ?>">
                                    <?php echo e(trans('words.blogs')); ?>

                                </a>
                            </li>
                            
                            <li class="<?php echo e(classActivePath('blog-category/list')); ?>">
                                <a href="<?php echo e(URL::to('admin/blog-category/list')); ?>">
                                    <?php echo e(trans('words.blog_category')); ?>

                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="submenu 
                    <?php echo e(classActivePath('propertyCities')); ?> <?php echo e(classActivePath('propertySubCities')); ?>

                    <?php echo e(classActivePath('propertyTowns')); ?> <?php echo e(classActivePath('propertyAreas')); ?>">
                    
                        <a href="#" <?php if(
                        classActivePath('propertyCities') or classActivePath('propertySubCities')
                        or classActivePath('propertyTowns') or classActivePath('propertyAreas')
                        ): ?> class="open" <?php endif; ?>>
                            <i class="md md-description"></i> 
                            Addresses
                        </a>
                        <ul <?php if(
                        classActivePath('propertyCities') or classActivePath('propertySubCities')
                        or classActivePath('propertyTowns') or classActivePath('propertyAreas')
                        ): ?> 
                            style="display: block" class="collapse in" <?php endif; ?>>

                            <li class="<?php echo e(classActivePath('propertyCities')); ?>">
                                <a href="<?php echo e(URL::to('admin/propertyCities')); ?>">
                                    City
                                </a>
                            </li>
                            
                            <li class="<?php echo e(classActivePath('propertySubCities')); ?>">
                                <a href="<?php echo e(route('propertySubCities.index')); ?>">
                                    Sub Cities
                                </a>
                            </li>
                            
                            <li class="<?php echo e(classActivePath('propertyTowns')); ?>">
                                <a href="<?php echo e(route('propertyTowns.index')); ?>">
                                    Towns
                                </a>
                            </li>
                            
                            <li class="<?php echo e(classActivePath('propertyAreas')); ?>">
                                <a href="<?php echo e(route('propertyAreas.index')); ?>">
                                    Areas
                                </a>
                            </li>
                        </ul>
                    </li>



                    <li class="<?php echo e(classActivePath('types')); ?>">
                        <a href="<?php echo e(URL::to('admin/types')); ?>">
                            <i class="fa fa-tags"></i>
                                <?php echo e(trans('words.property_type')); ?>

                            </a>
                        </li>

                    <li class="<?php echo e(classActivePath('properties_reports')); ?>">
                        <a href="<?php echo e(route('properties_reports.index')); ?>">
                            <i class="fa fa-tags"></i>
                            Property Reports
                        </a>
                    </li>

                    <li class="<?php echo e(classActivePath('property-purpose')); ?>">
                        <a href="<?php echo e(URL::to('admin/property-purpose')); ?>">
                            <i class="fa fa-tags"></i>
                            <?php echo e(trans('words.property_purpose')); ?>

                        </a>
                    </li>

                    <li class="<?php echo e(classActivePath('property-amenity')); ?>">
                        <a href="<?php echo e(URL::to('admin/property-amenity')); ?>">
                            <i class="fa fa-tags"></i>
                            <?php echo e(trans('words.property_amenity')); ?>

                        </a>
                    </li>

                    <li class="<?php echo e(classActivePath('properties')); ?>">
                        <a href="<?php echo e(URL::to('admin/properties')); ?>">
                            <i class="md md-pin-drop"></i>
                            <?php echo e(trans('words.properties')); ?>

                        </a>
                    </li>
                    
                    <li class="<?php echo e(classActivePath('inactive_properties_listing')); ?>">
                        <a href="<?php echo e(route('inactive_property_listview')); ?>">
                            <i class="md md-pin-drop"></i>
                            <?php echo e(trans('words.inactive_properties')); ?>

                        </a>
                    </li>

                    
                    <li class="submenu 
                    <?php echo e(classActivePath('click_counter')); ?>">
                    
                        <a href="#" <?php if( classActivePath('click_counter') ): ?> class="open" <?php endif; ?>>
                        <i class="fa fa-send"></i>
                            Traffic
                        </a>
                        <ul 
                            <?php if( classActivePath('click_counter')  ): ?> 
                            style="display: block" class="collapse in" 
                            <?php endif; ?>
                        >

                            <li class="<?php echo e(classActivePath('click_counter')); ?>">
                                <a href="<?php echo e(route('click_counter.index')); ?>">
                                    Click Counter
                                </a>
                            </li>
                            
                            <li class="<?php echo e(classActivePath('click_counter')); ?>">
                                <a href="<?php echo e(route('click_counter.index')); ?>">
                                    Click Counter
                                </a>
                            </li>
                            
                        </ul>
                    </li>


                    <li class="<?php echo e(classActivePath('featuredproperties')); ?>">
                        <a href="<?php echo e(URL::to('admin/featuredproperties')); ?>">
                            <i class="md md-star"></i>
                            <?php echo e(trans('words.featured')); ?>

                        </a>
                    </li>

                    <li class="<?php echo e(classActivePath('inquiries')); ?>">
                        <a href="<?php echo e(URL::to('admin/inquiries')); ?>">
                            <i class="fa fa-send"></i>
                            <?php echo e(trans('words.inquiries')); ?>

                        </a>
                    </li>

                    <li class="<?php echo e(classActivePath('slider')); ?>">
                        <a href="<?php echo e(URL::to('admin/slider')); ?>">
                            <i class="fa fa-sliders"></i>
                                <?php echo e(trans('words.home_slider')); ?>

                            </a>
                        </li>

                    <li class="<?php echo e(classActivePath('users')); ?>">
                        <a href="<?php echo e(URL::to('admin/users')); ?>">
                            <i class="fa fa-users"></i>
                                <?php echo e(trans('words.users')); ?>

                            </a>
                        </li>


                    <li class="<?php echo e(classActivePath('testimonials')); ?>">
                        <a href="<?php echo e(URL::to('admin/testimonials')); ?>">
                            <i class="fa fa-list"></i>
                            <?php echo e(trans('words.testimonials')); ?>

                        </a>
                    </li>

                    <li class="<?php echo e(classActivePath('subscriber')); ?>">
                        <a href="<?php echo e(URL::to('admin/subscriber')); ?>">
                            <i class="md md-email"></i>
                            <?php echo e(trans('words.subscribers')); ?>

                        </a>
                    </li>


                    <li class="<?php echo e(classActivePath('settings')); ?>">
                        <a href="<?php echo e(URL::to('admin/settings')); ?>">
                            <i class="md md-settings"></i>
                            <?php echo e(trans('words.settings')); ?>

                        </a>
                    </li>


                    <li class="submenu 
                        <?php echo e(classActivePath('about_page')); ?> 
                        <?php echo e(classActivePath('terms_page')); ?>

                        <?php echo e(classActivePath('privacy_policy_page')); ?>

                        <?php echo e(classActivePath('faq_page')); ?>

                        <?php echo e(classActivePath('properties_for_purpose_page')); ?>

                        <?php echo e(classActivePath('property_type_for_purpose_page')); ?>

                        <?php echo e(classActivePath('city_property_type_purpose_page')); ?>

                        <?php echo e(classActivePath('featured_properties_page')); ?>

                        
                        ">
                        <a  href="#" 
                            <?php if(classActivePath('about_page') 
                            or classActivePath('terms_page') 
                            or classActivePath('privacy_policy_page') 
                            or classActivePath('faq_page')): ?> 
                            class="active" 
                            <?php endif; ?>
                        >
                            <i class="md md-description"></i> 
                                <?php echo e(trans('words.pages')); ?> 
                                
                        </a>
                        <ul <?php if(
                                classActivePath('about_page') 
                                or classActivePath('terms_page') 
                                or classActivePath('privacy_policy_page') 
                                or classActivePath('faq_page')
                                or classActivePath('properties_for_purpose_page')
                                or classActivePath('property_type_for_purpose_page')
                                or classActivePath('city_property_type_purpose_page')
                                or classActivePath('featured_properties_page')
                                ): ?> 
                                style="display: block" class="collapse in" 
                            <?php endif; ?>
                            >
                            <li class="<?php echo e(classActivePath('about_page')); ?>">
                                <a href="<?php echo e(URL::to('admin/about_page')); ?>">
                                    <?php echo e(trans('words.about_us')); ?>

                                </a>
                            </li>
                            <li class="<?php echo e(classActivePath('terms_page')); ?>">
                                <a href="<?php echo e(URL::to('admin/terms_page')); ?>">
                                    <?php echo e(trans('words.terms_of_us')); ?>

                                </a>
                            </li>
                            <li class="<?php echo e(classActivePath('privacy_policy_page')); ?>">
                                <a href="<?php echo e(URL::to('admin/privacy_policy_page')); ?>">
                                    <?php echo e(trans('words.privacy_policy')); ?>

                                </a>
                            </li>
                            <li class="<?php echo e(classActivePath('faq_page')); ?>">
                                <a href="<?php echo e(URL::to('admin/faq_page')); ?>">
                                    <?php echo e(trans('words.faq')); ?>

                                </a>
                            </li>

                            <li class="<?php echo e(classActivePath('properties_for_purpose_page')); ?>">
                                <a href="<?php echo e(URL::to('admin/properties_for_purpose_page')); ?>">
                                    <?php echo e(trans('words.properties_for_purpose')); ?>

                                </a>
                            </li>
                            <li class="<?php echo e(classActivePath('property_type_for_purpose_page')); ?>">
                                <a href="<?php echo e(URL::to('admin/property_type_for_purpose_page')); ?>">
                                    <?php echo e(trans('words.property_type_for_purpose')); ?>

                                </a>
                            </li>
                            <li class="<?php echo e(classActivePath('city_property_type_purpose_page')); ?>">
                                <a href="<?php echo e(URL::to('admin/city_property_type_purpose_page')); ?>">
                                    <?php echo e(trans('words.city_property_type_purpose')); ?>

                                </a>
                            </li>
                            <li class="<?php echo e(classActivePath('featured_properties_page')); ?>">
                                <a href="<?php echo e(URL::to('admin/featured_properties_page')); ?>">
                                    <?php echo e(trans('words.featured_properties')); ?>

                                </a>
                            </li>

                        </ul>
                    </li>


                    
                <?php else: ?>
                    <li class="<?php echo e(classActivePath('dashboard')); ?>">
                        <a href="<?php echo e(URL::to('admin/dashboard')); ?>">
                            <i class="fa fa-dashboard"></i> 
                                <?php echo e(trans('words.dashboard_text')); ?>

                            </a>
                        </li>

                    <li class="<?php echo e(classActivePath('properties')); ?>">
                        <a href="<?php echo e(URL::to('admin/properties')); ?>">
                            <i class="md md-pin-drop"></i>
                            <?php echo e(trans('words.properties')); ?>

                        </a>
                    </li>
                    
                    <li class="<?php echo e(classActivePath('inactive_properties_listing')); ?>">
                        <a href="<?php echo e(URL::to('admin/inactive_properties_listing')); ?>">
                            <i class="md md-pin-drop"></i>
                            <?php echo e(trans('words.inactive_properties')); ?>

                        </a>
                    </li>

                    
                    <li class="submenu 
                    <?php echo e(classActivePath('click_counter')); ?> <?php echo e(classActivePath('traffic_per_month')); ?> <?php echo e(classActivePath('total_clicks')); ?> <?php echo e(classActivePath('top_Ten_Properties')); ?> <?php echo e(classActivePath('top_5_areas')); ?> <?php echo e(classActivePath('total_leads')); ?> ">
                    
                        <a href="#" <?php if( classActivePath('click_counter') or classActivePath('traffic_per_month') or classActivePath('total_clicks') or classActivePath('top_Ten_Properties') or classActivePath('top_5_areas') or classActivePath('total_leads') ): ?> class="open" <?php endif; ?>>
                        <i class="fa fa-send"></i>
                            Traffic
                        </a>
                        <ul 
                            <?php if( classActivePath('click_counter') or classActivePath('traffic_per_month') or classActivePath('total_clicks') or classActivePath('top_Ten_Properties') or classActivePath('top_5_areas') or classActivePath('total_leads')  ): ?> 
                            style="display: block" class="collapse in" 
                            <?php endif; ?>
                        >

                            <?php if(auth()->user()->usertype == 'Admin'): ?>
                                <li class="<?php echo e(classActivePath('click_counter')); ?>">
                                    <a href="<?php echo e(route('click_counter.index')); ?>">
                                        Click Counter
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li class="<?php echo e(classActivePath('traffic_per_month')); ?>">
                                <a href="<?php echo e(route('traffic_per_month')); ?>">
                                    Traffic / Month
                                </a>
                            </li>
                            
                            <li class="<?php echo e(classActivePath('total_clicks')); ?>">
                                <a href="<?php echo e(route('total_clicks')); ?>">
                                    Total Clicks
                                </a>
                            </li>
                            
                            <li class="<?php echo e(classActivePath('top_Ten_Properties')); ?>">
                                <a href="<?php echo e(route('top_Ten_Properties')); ?>">
                                    Top 10 Properties 
                                </a>
                            </li>
                            
                            <li class="<?php echo e(classActivePath('top_5_areas')); ?>">
                                <a href="<?php echo e(route('top_5_areas')); ?>">
                                    Top 5 Areas 
                                </a>
                            </li>
                            
                            <li class="<?php echo e(classActivePath('total_leads')); ?>">
                                <a href="<?php echo e(route('total_leads')); ?>">
                                    Total Leads 
                                </a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="<?php echo e(classActivePath('inquiries')); ?>">
                        <a href="<?php echo e(URL::to('admin/inquiries')); ?>">
                            <i class="md md-send"></i>
                            <?php echo e(trans('words.inquiries')); ?>

                        </a>
                    </li>

                    <li class="<?php echo e(classActivePath('admin')); ?>">
                        <a href="<?php echo e(URL::to('admin/profile')); ?>">
                            <i class="md md-person-outline"></i> 
                            <?php echo e(trans('words.account')); ?>

                        </a>
                    </li>
                    <li class="<?php echo e(classActivePath('users')); ?>">
                        <a href="<?php echo e(URL::to('admin/users')); ?>">
                            <i class="fa fa-users"></i>
                            Agents
                        </a>
                    </li>
                <?php endif; ?>


            </ul>


        </div>
    </div>
</div>
<!-- // Sidebar -->

<!-- Sidebar Right -->
<div class="sidebar right-side" id="sidebar-right">
    <!-- Wrapper Reqired by Nicescroll -->
    <div class="nicescroll">
        <div class="wrapper">
            <div class="block-primary">
                <div class="media">
                    <div class="media-left media-middle">
                        <a href="#">
                            <?php if($image_icon): ?>
                                <img src="<?php echo e($image_icon); ?>" width="60" alt="person"
                                    class="img-circle border-white">
                            <?php else: ?>
                                <img src="<?php echo e(URL::asset('admin_assets/images/guy.jpg')); ?>" alt="person"
                                    class="img-circle border-white" width="60" />
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="media-body media-middle">
                        <a href="<?php echo e(URL::to('admin/profile')); ?>"
                            class="h4"><?php echo e(Auth::user()->name); ?></a>
                        <a href="<?php echo e(URL::to('admin/logout')); ?>" class="logout pull-right"><i
                                class="md md-exit-to-app"></i></a>
                    </div>
                </div>
            </div>
            <ul class="nav nav-sidebar" id="sidebar-menu">
                <li><a href="<?php echo e(URL::to('admin/profile')); ?>"><i class="md md-person-outline"></i>
                        <?php echo e(trans('words.account')); ?></a></li>

                <?php if(Auth::user()->usertype == 'Admin'): ?>

                    <li><a href="<?php echo e(URL::to('admin/settings')); ?>"><i class="md md-settings"></i>
                            <?php echo e(trans('words.settings')); ?></a></li>

                <?php endif; ?>

                <li><a href="<?php echo e(URL::to('admin/logout')); ?>"><i class="md md-exit-to-app"></i>
                        <?php echo e(trans('words.logout')); ?></a></li>
            </ul>
        </div>
    </div>
</div>
<!-- // Sidebar -->
<?php /**PATH C:\xampp 7.4\htdocs\saakin\resources\views/admin/sidebar.blade.php ENDPATH**/ ?>