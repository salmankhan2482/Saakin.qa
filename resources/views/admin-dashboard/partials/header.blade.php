<div class="header">
        <nav class="navbar navbar-expand top-menu">
            <div class="collapse navbar-collapse justify-content-between">
                
                <ul class="navbar-nav header-right">

                    {{-- dashboard --}}
                    <li class="nav-item dropdown notification_dropdown">
                        <a href="{!! url('/index'); !!}" class="brand-logo">
                            <img class="brand-title" style="float: right" src="{{ asset('assets/images/black_logo.png') }}" alt="" width="100%">
                        </a>
                    </li>

                    {{-- agency --}}
                    <li class="nav-item dropdown notification_dropdown">

                        <a class="nav-link {{ Request::is('url', 'admin/agenc*') ? 'text-saakin' : '' }}" 
                            href="{{ route('agencies.index') }}">
                                Agencies
                        </a>
                    </li>

                    {{-- blogs --}}
                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link {{ Request::is('url', 'admin/blog*') ? 'text-saakin' : '' }} "
                            href="#" role="button" data-toggle="dropdown">
                                Blogs
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
                        <a class="nav-link"
                            href="#" role="button" data-toggle="dropdown">
                                Addresses
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
                        <a class="nav-link"
                            href="#" role="button" data-toggle="dropdown">
                                User Management
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
                                    <li>
                                        <a href="{{ route('roles.index') }}" class="timeline-panel">
                                            <div class="media-body">
                                                <h6 class="mb-1">Roles</h6>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    
                    {{-- Landing Pages --}}
                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link {{ Request::is('url', 'admin/landing-pages*') ? 'text-saakin' : '' }} "
                            href="#" role="button" data-toggle="dropdown">
                                Landing Pages
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
                                        <a href="{{ route('city-guide-landing-pages.index') }}" class="timeline-panel">
                                            <div class="media-body">
                                                <h6 class="mb-1">City Guide Page Content</h6>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('agency-landing-pages.index') }}" class="timeline-panel">
                                            <div class="media-body">
                                                <h6 class="mb-1">Agencies Pages</h6>
                                            </div>
                                        </a>
                                    </li>
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
                                Properties
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3">
                                <ul class="timeline">
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

                    {{-- Traffic  --}}
                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link " {{ Request::is('url', 'admin/propert*') ? 'text-saakin' : '' }} 
                            href="#" role="button" data-toggle="dropdown">
                                Traffic
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3">
                                <ul class="timeline">
                                    <li>
                                        <a href="{{ route('total_leads') }}" class="timeline-panel">
                                            <div class="media-body">
                                                <h6 class="mb-1">Total Leads</h6>
                                            </div>
                                        </a>
                                    </li>

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
                                                <h6 class="mb-1">Call to Action</h6>
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

                    {{-- Inquiries  --}}
                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link " {{ Request::is('url', 'admin/propert*') ? 'text-saakin' : '' }} 
                            href="#" role="button" data-toggle="dropdown">
                                Inquiries
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
                                                <h6 class="mb-1">Contact Inquiries</h6>
                                            </div>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </li>

                    {{-- City Guide  --}}
                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link " {{ Request::is('url', 'admin/propert*') ? 'text-saakin' : '' }} 
                            href="#" role="button" data-toggle="dropdown">
                                City Guides
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

                    
                </ul>
                <ul class="navbar-nav header-right ml-5">
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" style="padding: 0 16px 0 20px;">
                            <div class="header-info">
                                <span class="text-black">{{ auth()->user()->name }}</span>
                                <p class="fs-12 mb-0">{{ auth()->user()->usertype }}</p>
                            </div>
                            @if (auth()->user()->usertype == 'Agency' && auth()->user()->agency->image)
                                <img src="{{ URL::asset('upload/agencies/'.auth()->user()->agency->image) }}" width="20" alt="person">
                            @else
                                <img src="{{ URL::asset('upload/agencies/' . Auth::user()->image_icon ) }}" width="20"alt="person">
                            @endif
                        </a>
                        <div class="dropdown-menu w-50" style="left: 3em;">
                            <a href="{!! url('/app-profile'); !!}" class="dropdown-item ai-icon">
                                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span class="ml-2">Profile </span>
                            </a>
                            <a href="{!! URL::to('/'); !!}" class="dropdown-item ai-icon">
                                <i class="fa fa-eye"></i> 
                                <span class="ml-2">
                                    {{trans('words.view_site')}}
                                </span>
                            </a>
                            <a href="{!! route('admin.settings'); !!}" class="dropdown-item ai-icon">
                                <i class="fa fa-gear"></i> 
                                <span class="ml-2">
                                    {{trans('words.settings')}}
                                </span>
                            </a>
                            <a href="{!! url('logout'); !!}" class="dropdown-item ai-icon">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
