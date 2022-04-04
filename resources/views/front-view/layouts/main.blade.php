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
    
    {{-- <div class="whatsapp-chat">
        <a href=" https://wa.me/97470125000?text=I'm%20interested%20in%20your%20property%20posted%20on%20your%20website">
            <img src="{{ asset('assets/images/whatsapp_icon.png')}}" alt="WhatsApp Chat" width="80px" height="80px" >
        </a>
      </div> --}}
    @include('front-view.layouts.chat')
    @include('front-view.layouts.footer')

</body>

</html>