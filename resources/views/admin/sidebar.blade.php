<!-- Sidebar Left -->


<div class="sidebar left-side" id="sidebar-left">
    <div class="sidebar-user">
        <div class="media sidebar-padding">
            <div class="media-left media-middle">
                @if (Auth::user()->usertype == 'Agency')
                    @php
                        $agencyid = Auth::user()->agency_id;
                        $ag = \App\Agency::where('id', $agencyid)->first();
                        $image_icon = URL::asset('upload/agencies/' . $ag->image);
                    @endphp
                @else
                    @php
                        if (!empty(Auth::user()->image_icon)) {
                            $image_icon = URL::asset('upload/agencies/' . Auth::user()->image_icon);
                        }else{
                            $image_icon = URL::asset('admin_assets/images/guy.jpg');
                        }
                    @endphp
                @endif
                @if ($image_icon)
                    <img src="{{ $image_icon }}" width="60" alt="person" class="img-circle">
                @else
                    <img src="{{ URL::asset('admin_assets/images/guy.jpg') }}" alt="person" class="img-circle" width="60" />
                @endif
            </div>
            <div class="media-body media-middle">

                <a href="{{ URL::to('admin/profile') }}" class="h4 margin-none">{{ Auth::user()->name }}</a>
                <ul class="list-unstyled list-inline margin-none">
                    <li>
                        <a href="{{ URL::to('admin/profile') }}">
                            <i class="md-person-outline"></i>
                        </a>
                    </li>
                    @if (Auth::User()->usertype == 'Admin')
                        <li>
                            <a href="{{ URL::to('admin/settings') }}">
                                <i class="md-settings"></i>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ URL::to('admin/logout') }}">
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

                @if (Auth::user()->usertype == 'Admin')

                    <li class="{{ classActivePath('dashboard') }}">
                        <a href="{{ URL::to('admin/dashboard') }}">
                            <i class="fa fa-dashboard"></i> 
                            {{ trans('words.dashboard_text') }}
                        </a>
                    </li>

                    <li class="{{ classActivePath('scrapper') }}">
                        <a href="{{ URL::to('admin/scrapper') }}">
                            <i class="md md-description"></i> 
                            Scrapper
                        </a>
                    </li>

                    <li class=" submenu 
                    {{ classActivePath('menuOptions') }} 
                    {{ classActivePath('permissions') }} 
                    {{ classActivePath('roles') }} 
                    ">

                        <a href="#" 
                            @if (
                                classActivePath('menuOptions') 
                                or classActivePath('permissions')
                                or classActivePath('roles')
                                )  
                                class="open" 
                            @endif>

                            <i class="md-settings"></i> 

                            User Mgmt
                        </a>

                        <ul @if (
                                classActivePath('menuOptions') 
                                or classActivePath('permissions')
                                or classActivePath('roles')
                                ) 
                            style="display: block" 
                            class="collapse in" 
                            @endif>
                            
                            <li class="{{ classActivePath('menuOptions') }}">
                                <a href="{{ URL::to('admin/menuOptions') }}">
                                    Menu Options
                                </a>
                            </li>
                            
                            <li class="{{ classActivePath('permissions') }}">
                                <a href="{{ URL::to('admin/permissions') }}">
                                    Permissions
                                </a>
                            </li>
                            
                            <li class="{{ classActivePath('roles') }}">
                                <a href="{{ URL::to('admin/roles') }}">
                                    Roles
                                </a>
                            </li>
                           
                            
                        </ul>
                    </li>

                    <li class="{{ classActivePath('agencies') }}">
                        <a href="{{ URL::to('admin/agencies') }}">
                            <i class="fa fa-tags"></i>
                            {{ trans('words.agencies') }}
                        </a>
                    </li>



                    <li class=" submenu 
                                {{ classActivePath('properties-page-content') }} 
                                {{ classActivePath('landing-pages') }}
                                {{ classActivePath('city-guide-page-content') }}
                                {{ classActivePath('agencies-page-content') }}
                                ">

                        <a href="#" 
                            @if (
                                classActivePath('properties-page-content') 
                                or classActivePath('landing-pages')
                                or (classActivePath('city-guide-page-content')) 
                                or classActivePath('landing-pages')
                                or classActivePath('agencies-page-content')
                                )  
                                class="open" 
                            @endif>

                            <i class="md md-description"></i> 
                            {{ trans('words.landing_pages') }}
                        </a>

                        <ul @if (
                                classActivePath('properties-page-content') 
                                or classActivePath('landing-pages')
                                or classActivePath('city-guide-page-content')
                                or classActivePath('agencies-page-content')
                                ) 
                            style="display: block" 
                            class="collapse in" 
                            @endif>
                            
                            <li class="{{ classActivePath('properties-page-content') }}">
                                <a href="{{ URL::to('admin/landing-pages/properties-page-content') }}">
                                    {{ trans('words.properties_page_content') }}
                                </a>
                            </li>
                            <li class="{{ classActivePath('landing-pages') }}">
                                <a href="{{ URL::to('admin/landing-pages') }}">
                                    {{ trans('words.landing_pages_content') }}
                                </a>
                            </li>
                            <li class="{{ classActivePath('city-guide-page-content') }}">
                                <a  href="{{ URL::to('admin/city-guide-page-content') }}">
                                    {{ trans('words.city_guide_page_content') }}
                                </a>
                            </li>
                            <li class="{{ classActivePath('agencies-page-content') }}">
                                <a href="{{ URL::to('admin/agencies-page-content') }}">
                                    {{ trans('words.agencies_page_content') }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="submenu {{ classActivePath('cities') }} {{ classActivePath('city-detail/list') }}">
                        <a href="#" @if (classActivePath('cities') or classActivePath('city-detail/list')) class="open" @endif>
                            <i class="md md-description"></i> 
                            {{ trans('words.city_guides') }}
                        </a>
                        
                        <ul @if (classActivePath('cities') or classActivePath('city-detail/list')) style="display: block" 
                            class="collapse in" @endif>
                            <li class="{{ classActivePath('cities') }}">
                                <a href="{{ URL::to('admin/cities') }}">
                                    {{ trans('words.cities') }}
                                </a>
                            </li>
                            
                            <li class="{{ classActivePath('city-detail/list') }}">
                                <a href="{{ URL::to('admin/city-detail/list') }}">
                                    {{ trans('words.city_details') }}
                                </a>
                            </li>
                        </ul>

                    </li>

                    <li class="submenu {{ classActivePath('blogs') }} {{ classActivePath('blog-category/list') }}">
                        <a href="#" @if (classActivePath('blogs') or classActivePath('blog-category/list')) class="open" @endif>
                            <i class="md md-description"></i> 
                                {{ trans('words.blogs') }}
                        </a>
                        <ul @if (classActivePath('blogs') or classActivePath('blog-category/list')) 
                            style="display: block" class="collapse in" @endif>
                            <li class="{{ classActivePath('blogs') }}">
                                <a href="{{ route('blogs.index') }}">
                                    {{ trans('words.blogs') }}
                                </a>
                            </li>
                            
                            <li class="{{ classActivePath('blog-category/list') }}">
                                <a href="{{ route('blog-category.index') }}">
                                    {{ trans('words.blog_category') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="submenu 
                    {{ classActivePath('propertyCities') }} {{ classActivePath('propertySubCities') }}
                    {{ classActivePath('propertyTowns') }} {{ classActivePath('propertyAreas') }}">
                    
                        <a href="#" @if (
                        classActivePath('propertyCities') or classActivePath('propertySubCities')
                        or classActivePath('propertyTowns') or classActivePath('propertyAreas')
                        ) class="open" @endif>
                            <i class="md md-description"></i> 
                            Addresses
                        </a>
                        <ul @if (
                        classActivePath('propertyCities') or classActivePath('propertySubCities')
                        or classActivePath('propertyTowns') or classActivePath('propertyAreas')
                        ) 
                            style="display: block" class="collapse in" @endif>

                            <li class="{{ classActivePath('propertyCities') }}">
                                <a href="{{ URL::to('admin/propertyCities') }}">
                                    City
                                </a>
                            </li>
                            
                            <li class="{{ classActivePath('propertySubCities') }}">
                                <a href="{{ route('propertySubCities.index') }}">
                                    Sub Cities
                                </a>
                            </li>
                            
                            <li class="{{ classActivePath('propertyTowns') }}">
                                <a href="{{ route('propertyTowns.index') }}">
                                    Towns
                                </a>
                            </li>
                            
                            <li class="{{ classActivePath('propertyAreas') }}">
                                <a href="{{ route('propertyAreas.index') }}">
                                    Areas
                                </a>
                            </li>
                        </ul>
                    </li>



                    <li class="{{ classActivePath('types') }}">
                        <a href="{{ URL::to('admin/property-types') }}">
                            <i class="fa fa-tags"></i>
                                {{ trans('words.property_type') }}
                            </a>
                        </li>

                    <li class="{{ classActivePath('property_reports') }}">
                        <a href="{{ url('admin/property_reports') }}">
                            <i class="fa fa-tags"></i>
                            Property Reports
                        </a>
                    </li>

                    <li class="{{ classActivePath('property-purpose') }}">
                        <a href="{{ URL::to('admin/property-purpose') }}">
                            <i class="fa fa-tags"></i>
                            {{ trans('words.property_purpose') }}
                        </a>
                    </li>

                    <li class="{{ classActivePath('property-amenity') }}">
                        <a href="{{ URL::to('admin/property-amenity') }}">
                            <i class="fa fa-tags"></i>
                            {{ trans('words.property_amenity') }}
                        </a>
                    </li>

                    <li class="{{ classActivePath('properties') }}">
                        <a href="{{ URL::to('admin/properties') }}">
                            <i class="md md-pin-drop"></i>
                            {{ trans('words.properties') }}
                        </a>
                    </li>
                    
                    <li class="{{ classActivePath('inactive_properties_listing') }}">
                        <a href="{{ route('inactive_properties.index') }}">
                            <i class="md md-pin-drop"></i>
                            {{ trans('words.inactive_properties') }}
                        </a>
                    </li>


                    <li class="submenu  
                    {{ classActivePath('click_counter') }} {{ classActivePath('traffic_per_month') }}
                    {{ classActivePath('total_clicks') }} {{ classActivePath('top_Ten_Properties') }}
                    {{ classActivePath('top_5_areas') }} {{ classActivePath('total_leads') }}
                    {{ classActivePath('trafficUsers') }}
                    "> 
                    
                        <a href="#" 
                        @if ( classActivePath('click_counter') or classActivePath('traffic_per_month') or 
                        classActivePath('total_clicks') or classActivePath('top_Ten_Properties') or 
                        classActivePath('top_5_areas') or classActivePath('total_leads') or 
                        classActivePath('trafficUsers') ) class="open" @endif>

                        <i class="fa fa-send"></i>
                            Traffic
                        </a>
                        <ul 
                            @if (   classActivePath('click_counter') or classActivePath('traffic_per_month') or 
                                    classActivePath('total_clicks') or classActivePath('top_Ten_Properties') or 
                                    classActivePath('top_5_areas') or classActivePath('total_leads') or 
                                    classActivePath('trafficUsers')   ) 
                            style="display: block" class="collapse in" 
                            @endif
                        >

                            <li class="{{ classActivePath('click_counter') }}">
                                <a href="{{ route('click_counter.index') }}">
                                    Clicks
                                </a>
                            </li>

                            <li class="{{ classActivePath('traffic_per_month') }}">
                                <a href="{{ route('traffic_per_month') }}">
                                    Traffic
                                </a>
                            </li>

                            
                            <li class="{{ classActivePath('trafficUsers') }}">
                                <a href="{{ route('trafficUsers') }}">
                                    Users
                                </a>
                            </li>

                            
                            <li class="{{ classActivePath('top_Ten_Properties') }}">
                                <a href="{{ route('top_Ten_Properties') }}">
                                    Top 10 Properties 
                                </a>
                            </li>
                            
                            <li class="{{ classActivePath('top_5_areas') }}">
                                <a href="{{ route('top_5_areas') }}">
                                    Top 5 Areas 
                                </a>
                            </li>
                            
                            <li class="{{ classActivePath('total_leads') }}">
                                <a href="{{ route('total_leads') }}">
                                    Total Leads 
                                </a>
                            </li>

                            
                        </ul>
                    </li>


                    <li class="{{ classActivePath('featuredproperties') }}">
                        <a href="{{ URL::to('admin/featuredproperties') }}">
                            <i class="md md-star"></i>
                            {{ trans('words.featured') }}
                        </a>
                    </li>

                    <li class="submenu {{ classActivePath('property_inquiries') }} {{ classActivePath('agency_inquiries') }} {{ classActivePath('contact_inquiries') }}">
                        <a href="#" @if (classActivePath('property_inquiries') or classActivePath('agency_inquiries') or classActivePath('contact_inquiries')) class="open" @endif>
                            <i class="md md-description"></i> 
                                {{ trans('words.inquiries') }}
                        </a>
                        <ul @if (classActivePath('property_inquiries') or classActivePath('agency_inquiries') or classActivePath('contact_inquiries')) 
                            style="display: block" class="collapse in" @endif>
                            <li class="{{ classActivePath('property_inquiries') }}">
                                <a href="{{ URL::to('admin/property_inquiries') }}">
                                    {{ trans('words.property_inquiries') }}
                                </a>
                            </li>
                            
                            <li class="{{ classActivePath('agency_inquiries') }}">
                                <a href="{{ URL::to('admin/agency_inquiries') }}">
                                    {{ trans('words.agency_inquiries') }}
                                </a>
                            </li>

                            <li class="{{ classActivePath('contact_inquiries') }}">
                                <a href="{{ URL::to('admin/contact_inquiries') }}">
                                    {{ trans('words.contact_inquiries') }}
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="{{ classActivePath('slider') }}">
                        <a href="{{ URL::to('admin/slider') }}">
                            <i class="fa fa-sliders"></i>
                                {{ trans('words.home_slider') }}
                            </a>
                        </li>

                    <li class="{{ classActivePath('users') }}">
                        <a href="{{ URL::to('admin/users') }}">
                            <i class="fa fa-users"></i>
                                {{ trans('words.users') }}
                            </a>
                        </li>


                    <li class="{{ classActivePath('testimonials') }}">
                        <a href="{{ URL::to('admin/testimonials') }}">
                            <i class="fa fa-list"></i>
                            {{ trans('words.testimonials') }}
                        </a>
                    </li>

                    <li class="{{ classActivePath('subscriber') }}">
                        <a href="{{ URL::to('admin/subscriber') }}">
                            <i class="md md-email"></i>
                            {{ trans('words.subscribers') }}
                        </a>
                    </li>


                    <li class="{{ classActivePath('settings') }}">
                        <a href="{{ URL::to('admin/settings') }}">
                            <i class="md md-settings"></i>
                            {{ trans('words.settings') }}
                        </a>
                    </li>
                    
                    

                    <li class="submenu 
                        {{ classActivePath('about_page') }} 
                        {{ classActivePath('terms_page') }}
                        {{ classActivePath('privacy_policy_page') }}
                        {{ classActivePath('faq_page') }}
                        {{ classActivePath('properties_for_purpose_page') }}
                        {{ classActivePath('property_type_for_purpose_page') }}
                        {{ classActivePath('city_property_type_purpose_page') }}
                        {{ classActivePath('featured_properties_page') }}
                        
                        ">
                        <a  href="#" 
                            @if (classActivePath('about_page') 
                            or classActivePath('terms_page') 
                            or classActivePath('privacy_policy_page') 
                            or classActivePath('faq_page')) 
                            class="active" 
                            @endif
                        >
                            <i class="md md-description"></i> 
                                {{ trans('words.pages') }} 
                                {{-- <span class="pull-right label label-primary"></span> --}}
                        </a>
                        <ul @if (
                                classActivePath('about_page') 
                                or classActivePath('terms_page') 
                                or classActivePath('privacy_policy_page') 
                                or classActivePath('faq_page')
                                or classActivePath('properties_for_purpose_page')
                                or classActivePath('property_type_for_purpose_page')
                                or classActivePath('city_property_type_purpose_page')
                                or classActivePath('featured_properties_page')
                                ) 
                                style="display: block" class="collapse in" 
                            @endif
                            >
                            <li class="{{ classActivePath('about_page') }}">
                                <a href="{{ URL::to('admin/about_page') }}">
                                    {{ trans('words.about_us') }}
                                </a>
                            </li>
                            <li class="{{ classActivePath('terms_page') }}">
                                <a href="{{ URL::to('admin/terms_page') }}">
                                    {{ trans('words.terms_of_us') }}
                                </a>
                            </li>
                            <li class="{{ classActivePath('privacy_policy_page') }}">
                                <a href="{{ URL::to('admin/privacy_policy_page') }}">
                                    {{ trans('words.privacy_policy') }}
                                </a>
                            </li>
                            <li class="{{ classActivePath('faq_page') }}">
                                <a href="{{ URL::to('admin/faq_page') }}">
                                    {{ trans('words.faq') }}
                                </a>
                            </li>

                            <li class="{{ classActivePath('properties_for_purpose_page') }}">
                                <a href="{{ URL::to('admin/properties_for_purpose_page') }}">
                                    {{ trans('words.properties_for_purpose') }}
                                </a>
                            </li>
                            <li class="{{ classActivePath('property_type_for_purpose_page') }}">
                                <a href="{{ URL::to('admin/property_type_for_purpose_page') }}">
                                    {{ trans('words.property_type_for_purpose') }}
                                </a>
                            </li>
                            <li class="{{ classActivePath('city_property_type_purpose_page') }}">
                                <a href="{{ URL::to('admin/city_property_type_purpose_page') }}">
                                    {{ trans('words.city_property_type_purpose') }}
                                </a>
                            </li>
                            <li class="{{ classActivePath('featured_properties_page') }}">
                                <a href="{{ URL::to('admin/featured_properties_page') }}">
                                    {{ trans('words.featured_properties') }}
                                </a>
                            </li>

                        </ul>
                    </li>


                    {{-- agency dashboard rouetes --}}
                @else
                    <li class="{{ classActivePath('dashboard') }}">
                        <a href="{{ URL::to('admin/dashboard') }}">
                            <i class="fa fa-dashboard"></i> 
                                {{ trans('words.dashboard_text') }}
                            </a>
                        </li>

                    <li class="{{ classActivePath('properties') }}">
                        <a href="{{ URL::to('admin/properties') }}">
                            <i class="md md-pin-drop"></i>
                            {{ trans('words.properties') }}
                        </a>
                    </li>
                    
                    <li class="{{ classActivePath('inactive_properties_listing') }}">
                        <a href="{{ URL::to('admin/inactive_properties_listing') }}">
                            <i class="md md-pin-drop"></i>
                            {{ trans('words.inactive_properties') }}
                        </a>
                    </li>

                    {{-- traffic counter click routes --}}
                    <li class="submenu 
                    {{ classActivePath('click_counter') }} {{ classActivePath('traffic_per_month') }} {{ classActivePath('total_clicks') }} {{ classActivePath('top_Ten_Properties') }} {{ classActivePath('top_5_areas') }} {{ classActivePath('total_leads') }} ">
                    
                        <a href="#" @if ( classActivePath('click_counter') or classActivePath('traffic_per_month') or classActivePath('total_clicks') or classActivePath('top_Ten_Properties') or classActivePath('top_5_areas') or classActivePath('total_leads') ) class="open" @endif>
                        <i class="fa fa-send"></i>
                            Traffic
                        </a>
                        <ul 
                            @if ( classActivePath('click_counter') or classActivePath('traffic_per_month') or classActivePath('total_clicks') or classActivePath('top_Ten_Properties') or classActivePath('top_5_areas') or classActivePath('total_leads')  ) 
                            style="display: block" class="collapse in" 
                            @endif
                        >

                            <li class="{{ classActivePath('traffic_per_month') }}">
                                <a href="{{ route('traffic_per_month') }}">
                                    Traffic / Month
                                </a>
                            </li>
                            
                            <li class="{{ classActivePath('total_clicks') }}">
                                <a href="{{ route('total_clicks') }}">
                                    Total Clicks
                                </a>
                            </li>

                            <li class="{{ classActivePath('trafficUsers') }}">
                                <a href="{{ route('trafficUsers') }}">
                                    Users
                                </a>
                            </li>
                            
                            <li class="{{ classActivePath('top_Ten_Properties') }}">
                                <a href="{{ route('top_Ten_Properties') }}">
                                    Top 10 Properties 
                                </a>
                            </li>
                            
                            <li class="{{ classActivePath('top_5_areas') }}">
                                <a href="{{ route('top_5_areas') }}">
                                    Top 5 Areas 
                                </a>
                            </li>
                            
                            <li class="{{ classActivePath('total_leads') }}">
                                <a href="{{ route('total_leads') }}">
                                    Total Leads 
                                </a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="{{ classActivePath('inquiries') }}">
                        <a href="{{ URL::to('admin/inquiries') }}">
                            <i class="md md-send"></i>
                            {{ trans('words.inquiries') }}
                        </a>
                    </li>

                    <li class="{{ classActivePath('admin') }}">
                        <a href="{{ URL::to('admin/profile') }}">
                            <i class="md md-person-outline"></i> 
                            {{ trans('words.account') }}
                        </a>
                    </li>
                    <li class="{{ classActivePath('users') }}">
                        <a href="{{ URL::to('admin/users') }}">
                            <i class="fa fa-users"></i>
                            Agents
                        </a>
                    </li>
                @endif


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
                            @if ($image_icon)
                                <img src="{{ $image_icon }}" width="60" alt="person"
                                    class="img-circle border-white">
                            @else
                                <img src="{{ URL::asset('admin_assets/images/guy.jpg') }}" alt="person"
                                    class="img-circle border-white" width="60" />
                            @endif
                        </a>
                    </div>
                    <div class="media-body media-middle">
                        <a href="{{ URL::to('admin/profile') }}"
                            class="h4">{{ Auth::user()->name }}</a>
                        <a href="{{ URL::to('admin/logout') }}" class="logout pull-right"><i
                                class="md md-exit-to-app"></i></a>
                    </div>
                </div>
            </div>
            <ul class="nav nav-sidebar" id="sidebar-menu">
                <li><a href="{{ URL::to('admin/profile') }}"><i class="md md-person-outline"></i>
                        {{ trans('words.account') }}</a></li>

                @if (Auth::user()->usertype == 'Admin')

                    <li><a href="{{ URL::to('admin/settings') }}"><i class="md md-settings"></i>
                            {{ trans('words.settings') }}</a></li>

                @endif

                <li><a href="{{ URL::to('admin/logout') }}"><i class="md md-exit-to-app"></i>
                        {{ trans('words.logout') }}</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- // Sidebar -->
