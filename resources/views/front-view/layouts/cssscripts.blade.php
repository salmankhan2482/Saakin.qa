<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ @csrf_token() }}">

<link rel="canonical" href="{{ url()->current() }}" />


<title>@yield('title', getcong('site_name'))</title>
<meta name="description" content="@yield('description',  getcong('site_description'))">
<meta property="keywords" content="@yield('keyword', getcong('site_keywords'))" />
<meta property="og:type" content="@yield('type', getcong('head_type'))" />
<meta property="og:title" content="@yield('title',  getcong('site_name'))" />
<meta property="og:description" content="@yield('description',  getcong('site_description'))" />
<meta property="og:image" content="@yield('image', url('/upload/favicon1.png'))" />
<meta property="og:url" content="@yield('url', url('/'))" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="@saakin" />
<meta name="twitter:creator" content="@saakin" />

<meta property="og:url" content="@yield('url', url('/'))" />
<meta property="og:title" content="@yield('title',  getcong('site_name'))" />
<meta property="og:description" content="@yield('description',  getcong('site_description'))" />
<meta property="og:image" content="@yield('image',  url('/upload/favicon1.png'))" />

<!-- Fav and touch icons -->
<link href="{{ URL::asset('upload/' . getcong('site_favicon')) }}" rel="shortcut icon" type="image/x-icon" />
<link href="{{ asset('assets/css/fontawesome.css') }}" rel="stylesheet" />
@yield('style')
<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

@stack('styles')