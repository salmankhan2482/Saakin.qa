<style>
    .deznav{
        display: none !important;
    }
    @media only screen and (max-width: 780px) {
        .deznav{
            display: block !important;
        }
        .top-menu{
            display: none !important;
        }

    }
</style>

<div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                    <li><a class="has-arrow ai-icon" href="{!! url('/index'); !!}">
							<i class="flaticon-381-networking"></i>
							<span class="nav-text">Dashboard</span>
						</a>
                    </li>


                    <li @if( checkMenu('admin/menuOptions*') or checkMenu('admin/permissions*') ) 
                            class="mm-active" 
                        @endif >

                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-381-user"></i><span class="nav-text">User Management</span>
                        </a>
                        
                        <ul aria-expanded="false" >
                            <li @if(checkMenu('admin/menuOptions*'))  class="mm-active"  @endif>
                                <a href="{!! url('/admin/menuOptions'); !!}">Menu</a>
                            </li>

                            <li @if(checkMenu('admin/permissions*'))  class="mm-active"  @endif>
                                <a href="{!! url('/admin/permissions'); !!}">Permissions</a>
                            </li>
                            
                            <li @if(checkMenu('admin/roles*'))  class="mm-active"  @endif>
                                <a href="{!! url('/admin/roles'); !!}">Roles</a>
                            </li>

                        </ul>
                    </li>
                    
                    {{-- agency --}}
                    <li @if( checkMenu('admin/agencies*'))  class="mm-active" @endif>
                        <a class="has-arrow ai-icon" href="{{ route('agencies.index') }}">
                            <i class="flaticon-381-networking"></i>
                            <span class="nav-text">Agencies</span>
                        </a>

                    </li>


                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-381-home"></i>
                            <span class="nav-text">Properties</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{!! url('/admin/properties'); !!}">Properties</a></li>
                            <li><a href="{!! url('/table-datatable-basic'); !!}">Property Purposes</a></li>
                            <li><a href="{!! url('/table-datatable-basic'); !!}">Property Types</a></li>
                            <li><a href="{!! url('/table-bootstrap-basic'); !!}">Property Aminities</a></li>
                            <li><a href="{!! url('/table-datatable-basic'); !!}">Featured Properties</a></li>
                            <li><a href="{!! url('/table-datatable-basic'); !!}">Inactive Properties</a></li>
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Propety Locations</a>
                                <ul aria-expanded="false">
                                    <li><a href="{!! url('/email-compose'); !!}">Cities</a></li>
                                    <li><a href="{!! url('/email-inbox'); !!}">Sub Cities</a></li>
                                    <li><a href="{!! url('/email-read'); !!}">Towns</a></li>
                                    <li><a href="{!! url('/email-read'); !!}">Areas</a></li>
                                </ul>
                            </li>
                            <li><a href="{!! url('/table-datatable-basic'); !!}">Property Reports</a></li>
                        </ul>
                    </li>

                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-note"></i>
                        <span class="nav-text">Landing pages</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{!! url('/table-bootstrap-basic'); !!}">Properties Page Content</a></li>
                        <li><a href="{!! url('/table-bootstrap-basic'); !!}">Landing pages Content</a></li>
                        <li><a href="{!! url('/table-datatable-basic'); !!}">City Guide Page Content</a></li>
                        <li><a href="{!! url('/table-datatable-basic'); !!}">Agencies Page Content </a></li>
                    </ul>
                    </li>

                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-location"></i>
                        <span class="nav-text">City Guides</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{!! url('/table-bootstrap-basic'); !!}">Cities</a></li>
                        <li><a href="{!! url('/table-bootstrap-basic'); !!}">City Details</a></li>
                    </ul>
                    </li>

                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-note"></i>
                        <span class="nav-text">Blogs</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{!! url('/table-bootstrap-basic'); !!}">Blogs</a></li>
                        <li><a href="{!! url('/table-bootstrap-basic'); !!}">Blog Categories</a></li>
                    </ul>
                    </li>

                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-app"></i>
                        <span class="nav-text">Leads</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{!! url('/table-bootstrap-basic'); !!}">Clicks Impression</a></li>
                        <li><a href="{!! url('/table-bootstrap-basic'); !!}">Property Visits Impression</a></li>
                        <li><a href="{!! url('/table-bootstrap-basic'); !!}">Users Impression</a></li>
                        <li><a href="{!! url('/table-bootstrap-basic'); !!}">Top 10 Properties</a></li>
                        <li><a href="{!! url('/table-bootstrap-basic'); !!}">Top 5 Areas</a></li>
                    </ul>
                    </li>

                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="flaticon-381-notebook"></i>
                        <span class="nav-text">Front Pages</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{!! url('/table-bootstrap-basic'); !!}">About Us</a></li>
                        <li><a href="{!! url('/table-bootstrap-basic'); !!}">Terms of Use</a></li>
                        <li><a href="{!! url('/table-bootstrap-basic'); !!}">Privacy Policy</a></li>
                        <li><a href="{!! url('/table-bootstrap-basic'); !!}">FAQ's</a></li>
                    </ul>
                    </li>

                    <li><a href="{!! url('/widget-basic'); !!}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-notification"></i>
                        <span class="nav-text">Subscribers</span>
                        </a>
                    </li>

                    <li><a href="{!! url('/widget-basic'); !!}" class="ai-icon" aria-expanded="false">
                        <i class="flaticon-381-settings-2"></i>
                        <span class="nav-text">Settings</span>
                        </a>
                    </li>

                </ul>

				<div class="copyright">
				</div>
			</div>
        </div>