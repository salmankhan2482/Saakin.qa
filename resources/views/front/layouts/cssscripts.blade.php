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
<meta property="og:title" content="@yield('title',  getcong('site_name'))"  />
<meta property="og:description" content="@yield('description',  getcong('site_description'))"  />
<meta property="og:image" content="@yield('image',  url('/upload/favicon1.png'))"  />

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0DHP1WPHH9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0DHP1WPHH9');
</script>


<!-- Rich Result Test Code for https://saakin.com/ -->
<script type="application/ld+json">
{"@context":"http:\/\/schema.org","@type":"Corporation","logo":"https:\/\/www.saakin.qa\/upload/logo.png","url":"https:\/\/www.saakin.qa","brand":{"@type":"Brand","name":"Saakin Inc"},"name":"Saakin Qatar","address":"Tornado Tower, Majlis Al Taawon St, Doha, Qatar","contactPoint":{"@type":"ContactPoint","telephone":"+974 7012 5000","contactType":"customer service","contactOption":"HearingImpairedSupported","areaServed":"qa","availableLanguage":"en"},"sameAs":[]}
</script>
<!-- Google Adsene https://saakin.com/ -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2421573832685297"
     crossorigin="anonymous"></script>



<!-- Clarity tracking code for https://saakin.com/ -->
<script>
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i+"?ref=bwt";
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "9cpbk955xj");
</script>


<!-- Fav and touch icons -->
<link href="{{ URL::asset('upload/' . getcong('site_favicon')) }}" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="{{ URL::asset('site_assets/css/gallery_style.css') }}">

{{-- <link href="{{asset('assets/css/plugin.css')}}" rel="stylesheet" /> --}}

<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
<link 
    rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.min.css" />
<link href="{{ asset('assets/css/dropzone.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/jquery-ui.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet" />
<link href="{{ asset('site_assets/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/bootstrap-select.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/fontawesome.css') }}" rel="stylesheet" />


<link href="{{ asset('assets/css/ionicons.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/linear-icon.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/swiper.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/jquery-mb.ytplayer.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/datepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/leaflet.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/flaticon.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/plugin.css') }}" rel="stylesheet" />

<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/css/image-uploader.css') }}" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{ asset('assets/css/opansans.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/roboto.css') }}">

<link href="{{ asset('assets/css/new_custom.css') }}" rel="stylesheet" type="text/css" />
<style>
    /* mobile screen pagination styles */
    @media screen and ( max-width: 700px ){        
    .page-num li {
        display: none;
    }

    .page-num li:first-child,
    .page-num li:nth-child( 2 ),
    .page-num li:nth-last-child( 2 ),
    .page-num li:last-child,
    .page-num li.active,
    .page-num li.disabled {
        display: inline-block;
    }

    }


    .pac-container:after {
        background-image: none !important;
        height: 0px;
    }

    .swiper-slide {
        height: auto;
    }

    .hsq-heading:before,
    .service-box-container .service-box .title:before {
        bottom: 0;
        width: 250px;
        height: 1px;
        background: #d4d4d4;
    }

    .hsq-heading:after,
    .service-box-container .service-box .title:after {
        bottom: -1px;
        width: 100px;
        height: 3px;
        background: #50AEE6;
    }

    body.property-listing-page.row-listing .property-listing {
        margin-top: 25px;
    }

    .pac-container:after {
        background-image: none !important;
        height: 0px;
    }

    .agency-select{
        width: 100%; 
        justify-content: space-between;
        height: 2.2rem;
        width: 100%;
        color: #2d383f;
        background-color: #fff; 
        padding: 0.4rem 0.6rem 0.4rem 0.6rem;
        font-size: 1rem;
        border-radius: 0.3rem;
        cursor: pointer;
    }

</style>
