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

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0DHP1WPHH9"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-0DHP1WPHH9');
</script>

<!-- Rich Result Test Code for https://saakin.qa/ -->
<script type="application/ld+json">
    {"@context":"http:\/\/schema.org","@type":"Corporation","logo":"https:\/\/www.saakin.qa\/upload/logo.png","url":"https:\/\/www.saakin.qa","brand":{"@type":"Brand","name":"Saakin Inc"},"name":"Saakin Qatar","address":"Tornado Tower, Majlis Al Taawon St, Doha, Qatar","contactPoint":{"@type":"ContactPoint","telephone":"+974 7012 5000","contactType":"customer service","contactOption":"HearingImpairedSupported","areaServed":"qa","availableLanguage":"en"},"sameAs":[]}
    </script>

<!-- Clarity tracking code for https://saakin.qa/ -->
<script>
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i+"?ref=bwt";
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "9cpbk955xj");
</script>

@yield('style')

<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

@stack('styles')
