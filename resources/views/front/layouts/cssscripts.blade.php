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

<meta name="facebook-domain-verification" content="dagk5twy4ade2yb8vwnfchn65yuzh7" />

<!-- Fav and touch icons -->
<link href="{{ URL::asset('upload/' . getcong('site_favicon')) }}" rel="shortcut icon" type="image/x-icon" />
<link href="{{ asset('assets/css/fontawesome.css') }}" rel="stylesheet" />


<!-- Google Auto Ads Code -->

{{-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2421573832685297"
     crossorigin="anonymous"></script> --}}

     
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

<!-- Twitter universal website tag code -->
<script>
    !function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
    },s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='//static.ads-twitter.com/uwt.js',
    a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
    // Insert Twitter Pixel ID and Standard Event data below
    twq('init','o8t53');
    twq('track','PageView');
    </script>
    <!-- End Twitter universal website tag code -->

    <!-- Meta Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '483643002213916');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=483643002213916&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->
    
      {{-- Google Optimizer Code --}}
    <script src="https://www.googleoptimize.com/optimize.js?id=OPT-5QL22C6"></script>

@yield('style')

<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />

@stack('styles')

<style>

    .yellowStar{
        color: yellow;
        -webkit-text-stroke-width: 1px;
        -webkit-text-stroke-color: orange;
    }
    .social-div .btn-monochrome {
      --btn-bg-color: #fff;
      --btn-border-color: #e8e1e0;
      --btn-text-color: #2d383f;
      --btn-hover-bg-color: #f7f5f5;
      --btn-hover-border-color: #e8e1e0;
      --btn-hover-text-color: #403b45;
    }
    
    .hideAddress{
        display: -webkit-box; 
        -webkit-line-clamp: 1; 
        -webkit-box-orient: vertical; 
        overflow: hidden;
    }

    @media screen and (max-width: 455px){ 
    #rc-imageselect, .g-recaptcha { 
        transform:scale(0.80); 
        -webkit-transform:scale(0.80); 
        transform-origin:0 0; 
        -webkit-transform-origin:0 0; 
    }
        
    }
    .float{
        position:fixed;
        width:60px;
        height:60px;
        bottom:50px;
        right:15px;
        background-color:#25d366;
        color:#FFF;
        border-radius:50px;
        text-align:center;
        font-size:30px;
        box-shadow: 1px 1px 1px rgb(80, 80, 80);
        z-index:100;
    }
  
    .my-float{
        margin-top:16px;
    }
    .fa-login-google {
        font-size: 20px;
        background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        -webkit-text-fill-color: transparent;
    }

    .google-button {
        background-color: white !important;
        border: 1px solid #009fff !important;
        color: black !important;
    }

    .fa-login-facebook {
        font-size: 20px;
    }

    #name-error, #email-error, #register_email-error, #password_register-error, #password_confirmation-error, #terms-error{
        color: #ea4335;
    }

    .active-pagination {
      color: #fff;
      background-color: #009fff !important;
    }

    .page-link {
        padding: 0.225rem 0.55rem !important;
    }

    .active-search {
        border-color: #007ea8;
        background-color: #e8f4f6;
    }

</style>

