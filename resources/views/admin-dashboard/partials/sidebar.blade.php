<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">

            {{-- Dashboard --}}
            <li><a href="{!! Route('dashboard.index') !!}">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            {{-- agency --}}
            <li @if (checkMenu('admin/agencies*')) class="mm-active" @endif>
                <a href="{{ route('agencies.index') }}">
                    <i class="flaticon-381-user"></i>
                    <span class="nav-text">Agents</span>
                </a>

            </li>

            {{-- Blog --}}
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-note"></i>
                    <span class="nav-text">Blog</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('blogs.index') }}">Blogs</a></li>
                    <li><a href="{{ route('blog-category.index') }}">Blog Categories</a></li>
                </ul>
            </li>

            {{-- Location --}}
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-location"></i>
                    <span class="nav-text">Location</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('propertyCities.index') }}">Cities</a></li>
                    <li><a href="{{ route('propertySubCities.index') }}">Sub Cities</a></li>
                    <li><a href="{{ route('propertyTowns.index') }}">Towns</a></li>
                    <li><a href="{{ route('propertyAreas.index') }}">Areas</a></li>
                </ul>
            </li>

            {{-- User --}}
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-user"></i>
                    <span class="nav-text">User</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('permissions.index') }}">Permissions</a></li>
                    <li><a href="{{ route('roles.index') }}">Roles</a></li>
                    <li><a href="{{ route('users.index') }}">Users</a></li>
                </ul>
            </li>


            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-home"></i>
                    <span class="nav-text">Property Listing</span>
                </a>
                <ul aria-expanded="false">

                    <li><a href="{{ route('featuredproperties.index') }}">Featured Properties</a></li>
                    <li><a href="{{ url('admin/properties') }}">Properties</a></li>
                    <li><a href="{{ route('inactive_properties.index') }}">Inactive Properties</a></li>
                    <li><a href="{{ route('property-purpose.index') }}">Property Purposes</a></li>
                    <li><a href="{{ route('property-types.index') }}">Property Types</a></li>
                    <li><a href="{{ route('property-amenity.index') }}">Property Aminities</a></li>
                    <li><a href="{{ route('property-reports.index') }}">Property Reports</a></li>
                </ul>
            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-app"></i>
                    <span class="nav-text">Analytics</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('propertyVisits_per_month') }}">Property Visits</a></li>
                    <li><a href="{{ route('callToAction.index') }}">Click to Action</a></li>
                    <li><a href="{{ route('trafficUsers') }}">Unique Users</a></li>
                    <li><a href="{{ route('top_Ten_Properties') }}">Top 10 Properties</a></li>
                    <li><a href="{{ route('top_10_areas') }}">Top 10 Areas</a></li>
                </ul>
            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-location"></i>
                    <span class="nav-text">Guide</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('cities.index') }}">Cities</a></li>
                    <li><a href="{{ route('city-details') }}">City Details</a></li>
                </ul>
            </li>


            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-note"></i>
                    <span class="nav-text">pages</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('properties-page-content') }}">Properties Page Content</a></li>
                    <li><a href="{{ route('landing-pages.index') }}">Landing pages Content</a></li>
                    <li><a href="{{ route('popularSearches.index') }}">Popular Searches</a></li>
                    <li><a href="{{ route('agency-landing-pages.index') }}">Agencies Page Content </a></li>
                    <li><a href="{{ route('about_page') }}">About Us</a></li>
                    <li><a href="{{ route('terms_page') }}">Terms of Use</a></li>
                    <li><a href="{{ route('privacy_page') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('faq_page') }}">FAQ's</a></li>
                </ul>
            </li>



            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-app"></i>
                    <span class="nav-text">Leads</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('property_inquiries') }}">Property Inquiries</a></li>
                    <li><a href="{{ route('agency_inquiries') }}">Agency Inquiries</a></li>
                    <li><a href="{{ route('contact_inquiries') }}">Contact Us</a></li>
                    @if (auth()->user()->usertype == 'Admin')
                    <li> <a href="{{ route('companyRegistration.index') }}"> Company Registration</a> </li>
                    @endif
                </ul>
            </li>

            <li><a href="{!! route('admin.settings') !!}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-settings-2"></i>
                    <span class="nav-text">Settings</span>
                </a>
            </li>

        </ul>

        <div class="copyright">
        </div>
    </div>
</div>
