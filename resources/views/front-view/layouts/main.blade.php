<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    @include('front-view.layouts.cssscripts')
    <meta name="msvalidate.01" content="BF7297537F5BAA9011B7D901DECC0066" />
    @yield('schema-markup')
</head>

<body>
    @include('front-view.layouts.header')
    
    @yield('content')
    
    @include('front-view.layouts.chat')
    @include('front-view.layouts.footer')

</body>
</html>