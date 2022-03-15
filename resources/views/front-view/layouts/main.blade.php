<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    @include('front-view.layouts.cssscripts')
    <meta name="msvalidate.01" content="BF7297537F5BAA9011B7D901DECC0066" />
    {{--
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.css' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/fancybox.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/panzoom.controls.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/panzoom.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/carousel.css" /> --}}
</head>

<body>
    @include('front-view.layouts.header')
    @yield('content')
    @include('front-view.layouts.footer')

</body>

</html>