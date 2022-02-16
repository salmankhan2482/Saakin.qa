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
                    </div>
                </div>
            </div>
            <!-- Wrapper Reqired by Nicescroll (start scroll from here) -->
            <div class="nicescroll">
                <div class="wrapper" style="margin-bottom:90px">
                    <ul class="nav nav-sidebar" id="sidebar-menu">
                        
                        @foreach($menu_options as $menu_option)
                            @if(App\MenuOptions::find($menu_option->menu_option_id)->route!=null)

                            <li class="{{ classActivePath(App\MenuOptions::find($menu_option->menu_option_id)->url) }}">
                                <a href="{{ route(App\MenuOptions::find($menu_option->menu_option_id)->route) }}">
                                    <i class="{{ App\MenuOptions::find($menu_option->menu_option_id)->icon }}"></i> 
                                    {{App\MenuOptions::find($menu_option->menu_option_id)->title}}

                                </a>
                            </li>
                            
                            @else
                            
                            <li class=" submenu 
                                {{-- lopppp --}}
                                @foreach(App\MenuOptions::where('parent_id',$menu_option->menu_option_id)->get() as $sub_menu_options)
                                    {{ classActivePath($sub_menu_options->url) }} 
                                @endforeach ">

                                    <a href="#"
                                        @foreach(App\MenuOptions::where('parent_id',$menu_option->menu_option_id)->get() as $sub_menu_options)
                                        {{-- take the path which is visited from the above lopppp --}}
                                            @if ( classActivePath($sub_menu_options->url))  class="open" @endif
                                        @endforeach >
                                        
                                        <i class="{{ App\MenuOptions::find($menu_option->menu_option_id)->icon }}"></i> 
                                        {{App\MenuOptions::find($menu_option->menu_option_id)->title}}
                                    </a>

                                   
                                    <ul 
                                        @foreach(App\MenuOptions::where('parent_id',$menu_option->menu_option_id)->get() as $sub_menu_options)
                                            {{-- take the path which is visited from the above lopppp --}}
                                            @if ( classActivePath($sub_menu_options->url))  
                                                style="display: block"  class="collapse in"
                                            @endif

                                        @endforeach>

                                        @foreach(App\MenuOptions::where('parent_id',$menu_option->menu_option_id)->get() as $sub_menu_options)
                                            <li class="{{ classActivePath($sub_menu_options->url) }}">
                                                <a href="{{ route($sub_menu_options->route) }}">
                                                    {{$sub_menu_options->title}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                            </li>
                            @endif
                        @endforeach
                                
                       
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
        