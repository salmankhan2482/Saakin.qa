<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    @include('front.layouts.cssscripts')
    <meta name="msvalidate.01" content="BF7297537F5BAA9011B7D901DECC0066" />
    @yield('schema-markup')
</head>

<body>
    @include('cookieConsent::index')
    @include('front.layouts.header')
    
    @yield('content')
    
    @include('front.layouts.chat')
    @include('front.layouts.footer')

</body>
</html>