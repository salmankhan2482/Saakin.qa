<?php
 //Inquiries
 $data['inquiries'] = App\Enquire::
        when(auth()->user()->usertype == 'Agency', function($query){
            $query->where("agency_id", Auth::User()->agency_id);
        })
        ->where('enquire_id',2)
        ->orderBy('id', 'desc')
        ->get();
?>
<div class="header">
    <nav class="navbar navbar-expand top-menu">
        <div class="collapse navbar-collapse justify-content-between">
            <ul class="navbar-nav header-right">

                {{-- agency --}}
                <li class="nav-item dropdown notification_dropdown">

                    <a class="nav-link {{ Request::is('url', 'admin/agenc*') ? 'text-saakin' : '' }}"
                        href="{{ route('agencies.index') }}">
                        Agents
                    </a>
                </li>

                {{-- blogs --}}
                <li class="nav-item dropdown notification_dropdown">
                    <a class="nav-link {{ Request::is('url', 'admin/blog*') ? 'text-saakin' : '' }} " href="#"
                        role="button" data-toggle="dropdown">
                        Blog
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3">
                            <ul class="timeline">
                                <li>
                                    <a href="{{ route('blogs.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Blogs</h6>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('blog-category.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Blog Categories</h6>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </li>

                {{-- Addresses --}}
                <li class="nav-item dropdown notification_dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                        Location
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3">
                            <ul class="timeline">
                                <li>
                                    <a href="{{ route('propertyCities.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">cities</h6>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('propertySubCities.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Sub-Cities</h6>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('propertyTowns.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Towns</h6>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('propertyAreas.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Areas</h6>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </li>

                {{-- User Management --}}
                <li class="nav-item dropdown notification_dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                        User
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3">
                            <ul class="timeline">
                                <li>
                                    <a href="{{ route('users.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Users</h6>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('permissions.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Permissions</h6>
                                        </div>
                                    </a>
                                </li>
                                @can('role-list')
                                <li>
                                    <a href="{{ route('roles.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Roles</h6>
                                        </div>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </div>
                    </div>
                </li>

                {{-- Landing Pages --}}
                <li class="nav-item dropdown notification_dropdown">
                    <a class="nav-link {{ Request::is('url', 'admin/landing-pages*') ? 'text-saakin' : '' }} "
                        href="#" role="button" data-toggle="dropdown">
                        Pages
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3">
                            <ul class="timeline">
                                <li>
                                    <a href="{{ route('properties-page-content') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Properties Page Content</h6>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('landing-pages.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Landing Page Content</h6>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('popularSearches.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Popular Searches</h6>
                                        </div>
                                    </a>
                                </li>
                                {{-- <li>
                                    <a href="{{ route('city-guide-landing-pages.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">City Guide Page Content</h6>
                                        </div>
                                    </a>
                                </li> --}}
                                {{-- <li>
                                    <a href="{{ route('agency-landing-pages.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Agencies Pages</h6>
                                        </div>
                                    </a>
                                </li> --}}
                                <li>
                                    <a href="{{ route('about_page') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">About Us</h6>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('terms_page') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Terms of Use</h6>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('privacy_page') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Privacy Policy</h6>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('faq_page') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">FAQ's</h6>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </li>

                {{-- Property types purpose report active inactive amenity management --}}
                <li class="nav-item dropdown notification_dropdown">
                    <a class="nav-link " {{ Request::is('url', 'admin/propert*') ? 'text-saakin' : '' }}
                        href="#" role="button" data-toggle="dropdown">
                        Listing
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3">
                            <ul class="timeline">
                                <li>
                                    <a href="{{ route('featuredproperties.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Featured Properties</h6>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('admin/properties') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Active Properties</h6>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('inactive_properties.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">In-Active Properties</h6>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('property-types.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Property Types</h6>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('property-purpose.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Property Purposes</h6>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('property-amenity.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Property Amenity</h6>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('property-reports.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Property Reports</h6>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>

                {{-- Traffic --}}
                <li class="nav-item dropdown notification_dropdown">
                    <a class="nav-link " {{ Request::is('url', 'admin/propert*') ? 'text-saakin' : '' }}
                        href="#" role="button" data-toggle="dropdown">
                        Analytics
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3">
                            <ul class="timeline">

                                <li>
                                    <a href="{{ route('propertyVisits_per_month') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Property Visits</h6>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('callToAction.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Click to Action</h6>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('trafficUsers') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Unique Users</h6>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('top_Ten_Properties') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Top 10 Properties</h6>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('top_5_areas') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Top 5 Areas</h6>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </li>

                {{-- Inquiries --}}
                <li class="nav-item dropdown notification_dropdown">
                    <a class="nav-link " {{ Request::is('url', 'admin/propert*') ? 'text-saakin' : '' }}
                        href="#" role="button" data-toggle="dropdown">
                        Leads
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3">
                            <ul class="timeline">
                                <li>
                                    <a href="{{ route('property_inquiries') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Property Inquiries</h6>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('agency_inquiries') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Agency Inquiries</h6>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('contact_inquiries') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Contact Us</h6>
                                        </div>
                                    </a>
                                </li>
                                
                                @if (auth()->user()->usertype == 'Admin')
                                <li>
                                    <a href="{{ route('companyRegistration.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Company Registration</h6>
                                        </div>
                                    </a>
                                </li>
                                @endif

                                <li>
                                    <a href="{{ route('subscriber') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Subscribers</h6>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </li>

                {{-- City Guide --}}
                <li class="nav-item dropdown notification_dropdown">
                    <a class="nav-link " {{ Request::is('url', 'admin/propert*') ? 'text-saakin' : '' }}
                        href="#" role="button" data-toggle="dropdown">
                        Guide
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3">
                            <ul class="timeline">
                                <li>
                                    <a href="{{ route('cities.index') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">Cities</h6>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('city-details') }}" class="timeline-panel">
                                        <div class="media-body">
                                            <h6 class="mb-1">City Details</h6>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </li>

                <li class="nav-item dropdown notification_dropdown">
                    <a class="nav-link  ai-icon" href="#" role="button" data-toggle="dropdown">
                        <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.75 14.8385V12.0463C21.7471 9.88552 20.9385 7.80353 19.4821 6.20735C18.0258 4.61116 16.0264 3.61555 13.875 3.41516V1.625C13.875 1.39294 13.7828 1.17038 13.6187 1.00628C13.4546 0.842187 13.2321 0.75 13 0.75C12.7679 0.75 12.5454 0.842187 12.3813 1.00628C12.2172 1.17038 12.125 1.39294 12.125 1.625V3.41534C9.97361 3.61572 7.97429 4.61131 6.51794 6.20746C5.06159 7.80361 4.25291 9.88555 4.25 12.0463V14.8383C3.26257 15.0412 2.37529 15.5784 1.73774 16.3593C1.10019 17.1401 0.751339 18.1169 0.75 19.125C0.750764 19.821 1.02757 20.4882 1.51969 20.9803C2.01181 21.4724 2.67904 21.7492 3.375 21.75H8.71346C8.91521 22.738 9.45205 23.6259 10.2331 24.2636C11.0142 24.9013 11.9916 25.2497 13 25.2497C14.0084 25.2497 14.9858 24.9013 15.7669 24.2636C16.548 23.6259 17.0848 22.738 17.2865 21.75H22.625C23.321 21.7492 23.9882 21.4724 24.4803 20.9803C24.9724 20.4882 25.2492 19.821 25.25 19.125C25.2486 18.117 24.8998 17.1402 24.2622 16.3594C23.6247 15.5786 22.7374 15.0414 21.75 14.8385ZM6 12.0463C6.00232 10.2113 6.73226 8.45223 8.02974 7.15474C9.32723 5.85726 11.0863 5.12732 12.9212 5.125H13.0788C14.9137 5.12732 16.6728 5.85726 17.9703 7.15474C19.2677 8.45223 19.9977 10.2113 20 12.0463V14.75H6V12.0463ZM13 23.5C12.4589 23.4983 11.9316 23.3292 11.4905 23.0159C11.0493 22.7026 10.716 22.2604 10.5363 21.75H15.4637C15.284 22.2604 14.9507 22.7026 14.5095 23.0159C14.0684 23.3292 13.5411 23.4983 13 23.5ZM22.625 20H3.375C3.14298 19.9999 2.9205 19.9076 2.75644 19.7436C2.59237 19.5795 2.50014 19.357 2.5 19.125C2.50076 18.429 2.77757 17.7618 3.26969 17.2697C3.76181 16.7776 4.42904 16.5008 5.125 16.5H20.875C21.571 16.5008 22.2382 16.7776 22.7303 17.2697C23.2224 17.7618 23.4992 18.429 23.5 19.125C23.4999 19.357 23.4076 19.5795 23.2436 19.7436C23.0795 19.9076 22.857 19.9999 22.625 20Z" fill="#3B4CB8"/>
                        </svg>
                        @if (count($data['inquiries']) > 0)
                            <div class="pulse-css"></div>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3 height380" style="overflow: auto">
                            <ul class="timeline">
                               
                                @foreach ($data['inquiries'] as $inquiry)
                                
                                    <li>
                                    <div class="timeline-panel">
                                        <div class="media-body">
                                            @if ($inquiry->type == 'Contact Inquiry')
                                            <a href="{{ url('admin/view_contact_inquiry', $inquiry->id ) }}">
                                                <h6 class="mb-1">{{$inquiry->type}}</h6>
                                                <small class="d-block">{{ date('d-m-Y', strtotime($inquiry->created_at)) }}</small>
                                            </a>
                                            @elseif ($inquiry->type == 'Agency Inquiry')
                                               <a href="{{ url('admin/view_agency_inquiry', $inquiry->id )}}">
                                                    <h6 class="mb-1">{{$inquiry->type}} to {{$inquiry->Agencies->name ??''}}</h6>
                                                    <small class="d-block">{{ date('d-m-Y', strtotime($inquiry->created_at)) }}</small>
                                                </a>
                                            @elseif ($inquiry->type == 'Company Registration Inquiry')
                                               <a href="{{ route('companyRegistration.destroy', $inquiry->company_registrations_id) }}">
                                                    <h6 class="mb-1">{{$inquiry->type}}</h6>
                                                    <small class="d-block">{{ date('d-m-Y', strtotime($inquiry->created_at)) }}</small>
                                                </a>
                                            @else
                                            <a href="{{ url('admin/view_property_inquiry', $inquiry->id )}}">
                                            <h6 class="mb-1">{{$inquiry->type}} to {{$inquiry->Agencies->name ??''}}</h6>
                                            <small class="d-block">{{ date('d-m-Y', strtotime($inquiry->created_at)) }}</small>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                    </li>
                                @endforeach
                                    <li>
                        <a class="all-notification" href="{{ route('notifications')}}">See all<i class="ti-arrow-right"></i></a>

                                    </li>
                                
                            </ul>
                        </div>
                    </div>
                </li>
                
            </ul>


            <ul class="navbar-nav header-right ml-5">
                <li class="nav-item dropdown header-profile">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown"
                        style="padding: 0 30px 0 0px;">
                        <div class="header-info">
                            <span style="line-height: 22px;">{{ Str::limit(auth()->user()->name,20, '')  }}</span>
                            <p class="fs-12 mb-0">{{ auth()->user()->usertype }}</p>
                        </div>
                        @if (auth()->user()->usertype == 'Agency' && auth()->user()->agency->image)
                            <img src="{{ URL::asset('upload/agencies/' . auth()->user()->agency->image) }}" width="20"
                                alt="person">
                        @else
                            <img src="{{ URL::asset('upload/agencies/' . Auth::user()->image_icon) }}" width="20"
                                alt="person">
                        @endif
                    </a>
                    <div class="dropdown-menu w-50" style="left: 3em;">
                        <a href="{!! route('profile') !!}" class="dropdown-item ai-icon">
                            <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span class="ml-2">Profile </span>
                        </a>
                        <a href="{!! URL::to('/') !!}" class="dropdown-item ai-icon">
                            <i class="fa fa-eye"></i>
                            <span class="ml-2">
                                {{ trans('words.view_site') }}
                            </span>
                        </a>
                        @if (auth()->user()->usertype == 'Admin')
                            <a href="{!! route('admin.settings') !!}" class="dropdown-item ai-icon">
                                <i class="fa fa-gear"></i>
                                <span class="ml-2">
                                    {{ trans('words.settings') }}
                                </span>
                            </a>
                        @endif
                        <a href="{!! url('logout') !!}" class="dropdown-item ai-icon">
                            <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18"
                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            <span class="ml-2">Logout </span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>