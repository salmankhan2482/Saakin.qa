<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('dz.name') }} </title>

	<meta name="description" content="Saakin Real Estate"/>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/images/favicon.png') }}">

	@if(!empty(config('dz.public.pagelevel.css.'.$action)))
        @foreach(config('dz.public.pagelevel.css.'.$action) as $style)
            <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
		@endforeach
    @endif

	{{-- Global Theme Styles (used by all pages) --}}
	@if(!empty(config('dz.public.global.css')))
		@foreach(config('dz.public.global.css') as $style)
			<link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
		@endforeach
	@endif

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @yield('style') 
    <style>
        .action-btn{
            margin-left: 5px;
            font-size: 1em;
        }
        .text-saakin{
            color: #009fff !important;
        }
        .deznav {
        display: none !important;
        }

        /* @media only screen and (max-width: 780px) {
            .deznav {
                display: block !important;
            }

            .top-menu {
                display: none !important;
            }

        } */
        .select2-container .select2-selection--multiple{
            height: 40px;
        }
    </style>

</head>
<body>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper">
        <div class="nav-header">
            <a href="{!! route('new_dashboard'); !!}" class="brand-logo">
                <img class="brand-title" style="float: right" src="{{ asset('assets/images/black_logo.png') }}" alt="" width="100%">
            </a>
             <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div> 
		@include('admin-dashboard.partials.topbar')
		@include('admin-dashboard.partials.header')
        @include('admin-dashboard.partials.sidebar')

        <div class="content-body">
            @yield('content')
        </div>

		@include('admin-dashboard.partials.footer')
    </div>

	@include('admin-dashboard.partials.footer-scripts')
    <script src="https://cdn.ckeditor.com/4.13.0/full/ckeditor.js"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script> --}}
    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
</body>
</html>
