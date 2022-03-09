<div class="header">
        <nav class="navbar navbar-expand top-menu">
            <div class="collapse navbar-collapse justify-content-between">
                
                <ul class="navbar-nav header-right">

                    {{-- dashboard --}}
                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link {{ Request::is('url', 'admin/dashboard*') ? 'text-saakin' : '' }}" href="{{ url('/admin/dashboard/new') }}"  >
                                Dashboard
                        </a>
                    </li>

                    {{-- user management --}}
                    {{-- <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link " href="#" role="button" data-toggle="dropdown">
                                User Management
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3">
                                <ul class="timeline">
                                    <li>
                                        <a href="{!! url('/admin/menuOptions'); !!}" class="timeline-panel">
                                            <div class="media-body">
                                                <h6 class="mb-1">Menu</h6>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{!! url('/admin/permissions'); !!}" class="timeline-panel">
                                            <div class="media-body">
                                                <h6 class="mb-1">Permissions</h6>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{!! url('/admin/roles'); !!}">
                                            <div class="media-body">
                                                <h6 class="mb-1">Roles</h6>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li> --}}

                    {{-- agency --}}
                    <li class="nav-item dropdown notification_dropdown">

                        <a class="nav-link {{ Request::is('url', 'admin/agenc*') ? 'text-saakin' : '' }}" 
                            href="{{ route('agencies.index') }}">
                                Agencies
                        </a>
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
                                        <a href="{{ route('property-landing-pages') }}" class="timeline-panel">
                                            <div class="media-body">
                                                <h6 class="mb-1">Properties Pages</h6>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('landing-pages') }}" class="timeline-panel">
                                            <div class="media-body">
                                                <h6 class="mb-1">Landing Pages</h6>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('city-guide-landing-pages') }}" class="timeline-panel">
                                            <div class="media-body">
                                                <h6 class="mb-1">City Guide Pages</h6>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('agency-landing-pages') }}" class="timeline-panel">
                                            <div class="media-body">
                                                <h6 class="mb-1">Agencies Pages</h6>
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
                                        <a href="{{ route('property_listview') }}" class="timeline-panel">
                                            <div class="media-body">
                                                <h6 class="mb-1">Active Properties</h6>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('inactive_property_listview') }}" class="timeline-panel">
                                            <div class="media-body">
                                                <h6 class="mb-1">In-Active Pages</h6>
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

                </ul>
            </div>
        </nav>
</div>
