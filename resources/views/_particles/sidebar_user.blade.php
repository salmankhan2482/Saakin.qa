<div class="col-lg-3 col-md-3 sidebar-left">
      <div class="widget member-card">
        <div class="member-card-header">
          <a href="Javascript::void();" class="member-card-avatar">
            @if(Auth::user()->image_icon AND file_exists(public_path('upload/members/'.Auth::user()->image_icon.'-s.jpg')))
              <img src="{{ URL::asset('upload/members/'.Auth::user()->image_icon.'-s.jpg') }}" alt="sidebar_user.blade.php">
            @else
              <img src="{{ URL::asset('site_assets/img/user_demo.png') }}" alt="sidebar_user.blade.php">
            @endif


          </a>
          <h3>{{ Auth::user()->name }}</h3>
          <p><i class="fa fa-envelope icon"></i>{{ Auth::user()->email }}</p>
        </div>
        <div class="member-card-content">

          <ul>
             
            <li class="{{classActiveUserMenu('profile')}}">
              <a href="{{ URL::to('profile') }}">
                  <i class="fa fa-user icon"></i>
                  {{trans('words.profile')}}
              </a>
            </li>

            <li class="{{classActiveUserMenu('change_pass')}}">
              <a href="{{ URL::to('change_pass') }}">
                  <i class="fa fa-lock icon"></i>
                  {{trans('words.change_password')}}
              </a>
            </li>

            <li>
              <a href="{{ URL::to('logout') }}">
                <i class="fa fa-sign-out icon"></i>
                {{trans('words.logout')}}
              </a>
            </li>

          </ul>
        </div>
      </div>
    </div>
