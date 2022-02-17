<!-- Sidebar Left -->

<?php

    $role=App\RoleUser::where('user_id',\Illuminate\Support\Facades\Auth::user()->id)->pluck('role_id');
    $menu_options=App\MenuOptionsRole::wherein('role_id',$role)->select('role_id','menu_option_id')->get()->unique('menu_option_id');

    if($role->contains(1))
    {
        Illuminate\Support\Facades\Session::put('role',1);

    }
    else{
        Illuminate\Support\Facades\Session::put('role',$role->first());
    }

?>

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
                                    $image_icon = URL::asset('upload/members/' . Auth::user()->image_icon . '-s.jpg');
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

                    </li>


                    <li class="{{ classActivePath('featuredproperties') }}">
                        <a href="{{ URL::to('admin/featuredproperties') }}">
                            <i class="md md-star"></i>
                            {{ trans('words.featured') }}
                        </a>
                    </li>

                    {{-- <li class="{{ classActivePath('inquiries') }}">
                        <a href="{{ URL::to('admin/inquiries') }}">
                            <i class="fa fa-send"></i>
                            {{ trans('words.inquiries') }}
                        </a>
                    </li> --}}

                    <li class="submenu
                        {{ classActivePath('property_inquiries') }}
                        {{ classActivePath('agency_inquiries') }} 
                        {{ classActivePath('contact_inquiries') }}
                        ">
                        <a href="#" @if (
                        classActivePath('property_inquiries')
                        or classActivePath('agency_inquiries') 
                        or classActivePath('contact_inquiries')
                        ) class="open" 
                        @endif>
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
        