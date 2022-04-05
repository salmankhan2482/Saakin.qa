<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    
    @yield('schema-markup')
    

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
    
    
    <!-- Google Adsene https://saakin.qa/ -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2421573832685297"
         crossorigin="anonymous"></script>
    
    
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
    
    
    <!-- Fav and touch icons -->
    <link href="{{ URL::asset('upload/' . getcong('site_favicon')) }}" rel="shortcut icon" type="image/x-icon" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.min.css" />
    <link rel="stylesheet" href="{{ URL::asset('site_assets/css/gallery_style.css') }}">
    <link href="{{ asset('assets/css/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/fontawesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
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
    
    <meta name="msvalidate.01" content="BF7297537F5BAA9011B7D901DECC0066" />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.css' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/fancybox.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/panzoom.controls.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/panzoom.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.0/dist/carousel.css" />
</head>

<body>
@include('front.layouts.header')
@yield('content')



 {{-- input to store the value and then using for search purpose --}}
 <input type="hidden" id="globalPropertyPurposeValue" value="{{ $request->property_purpose ?? 'Rent' }}">
 <input type="hidden" id="globalPropertyTypeValue" value="{{ request('type')->id ?? '' }}">

<div class="footer-wrapper v3">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-logo"><a href="{{ URL::to('/') }}">
                            <img src="{{ URL::asset('upload/logo.png') }}"
                                alt="{{ getcong('site_name') . 'Logo Pic' }}">
                        </a></div>
                </div>
                <div class="col-md-3 ml-auto">
                    <div class="footer-social-wrap text-white" >
                        <span>Follow us on</span>
                        <ul class="social-buttons style2">
                            <li><a target="_blank" href="{{ getcong('social_facebook') }}">
                                <i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li><a target="_blank" href="{{ getcong('social_instagram') }}">
                                <i class="fab fa-instagram"></i></a></li>
                            <li><a target="_blank" href="{{ getcong('social_linkedin') }}">
                                <i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-top-area">
        <div class="container">
            <div class="row nav-folderized">
                <div class="col-lg-3 col-md-12">
                    <div class="footer-content nav">
                        <h2 class="title">{{ getcong('footer_widget1_title') }}</h2>
                        <ul class="list res-list">
                            {!! stripslashes(getcong('footer_widget1')) !!}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="footer-content nav">
                        <h2 class="title">{{ getcong('footer_widget2_title') }}</h2>
                        <ul class="list res-list">
                            {!! stripslashes(getcong('footer_widget2')) !!}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="footer-content nav">
                        <h2 class="title">{{ getcong('footer_widget3_title') }}</h2>
                        <ul class="list res-list">
                            {!! stripslashes(getcong('footer_widget3')) !!}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="footer-content">
                        <h4 class="title">Sign up for the newsletter</h4>
                        <div class="value-input-wrap newsletter">
                            @include('front.pages.include.newsletter')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 offset-md-2">
                    <p style="color: white;"> {!! getcong('site_copyright') !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@include('front.modals.userlogin')
@include('front.pages.include.emailModal')
@include('front.modals.propertyReportModal')
@include('front.layouts.home_jss')

@yield('scripts-custom')

<script>

    $(document).ready(function(){
        var purposeValue = $("#property_purpose").val();
        $('#globalPropertyPurposeValue').val(purposeValue);

    });

    function setPropertyPurpose(pp) {
            $('#property_purpose').val(pp);
            $('.property_purpose').val(pp);
            $('#globalPropertyPurposeValue').val(pp);
            
            $.ajax({
            url:"select/buyRent/for/search/"+pp,
            success:function(data){
                $('.ajaxChange').html(data);
            }
            });

        }//changing featured products on click of rent and buy on search page
    
        function setPropertyType(pp) {
            $('#globalPropertyTypeValue').val(pp.value);
        }//changing featured products on click of rent and buy on search page


    $(document).on("click", "#emailBtn", function() {
        var image = $(this).attr('data-image');
        $("#modalImg").attr("src", `${image}`);
        // $("#modalImg").attr("src", `upload/properties/thumb_${image}`);
        var title = $(this).attr('data-title');
        $("#modalName").html(title);
        var agent = $(this).attr('data-agent');
        $("#modalAgent").html(agent);
        var broker = $(this).attr('data-broker');
        $("#modalBroker").html(broker);

        var bedroom = $(this).attr('data-bedroom');
        $("#modalBedrooms").html(bedroom);

        var bathroom = $(this).attr('data-bathroom');
        $("#modalBathrooms").html(bathroom);

        var area = $(this).attr('data-area');
        $("#modalSqm").html(area);
    });


    //desktop search
    $('#country').on('keyup', function() {
        var query = $(this).val();
        var purpose = $("#globalPropertyPurposeValue").val();
        var type = $("#globalPropertyTypeValue").val();

        if (query != '') {
            $.ajax({
                url: "{{ route('search-desktop') }}",
                type: "GET",
                data: {
                    'country': query,
                    'purpose': purpose,
                    'type': type
                },
                success: function(data) {
                    $('#country_list').show();
                    $('#country_list').html(data);
                }
            }) //ajax call ends

        } else {
            $('#country_list').hide();
        } //if else ends
    });


    $(document).on('click', '.live-search-li', function() {
        var query = 'Stop';

        var value = $(this).text();
        $('#country').val(value);
        $('#extra_keywords').html($(this).html());
        $('#country_list').html("");
    });


    //mobile serach 
    $('.countryMbl').on('keyup', function() {
        var query = $(this).val();
        var purpose = $("#globalPropertyPurposeValue").val();
        var type = $("#globalPropertyTypeValue").val();

        if (query != '') {
            $.ajax({
                url: "{{ route('search-mobile') }}",
                type: "GET",
                data: {
                    'country': query,
                    'purpose': purpose,
                    'type': type
                },
                success: function(data) {
                    $('#country_list_mbl').show();
                    $('#country_list_mbl').html(data);
                }
            }) //ajax call ends

        } else {
            $('#country_list_mbl').hide();
        } //if else ends
    });


    $(document).on('click', '.live-search-li', function() {
        var query = 'Stop';

        var value = $(this).text();
        $('.countryMbl').val(value);
        $('.extra_keywords').html($(this).html());
        $('#country_list_mbl').html("");
    }); //mbl search



    $('.property_purpose').click(function() {
        $('.property_purpose').removeClass('btn-danger').removeClass('btn-secondary');
        $('.property_purpose').addClass('btn-secondary');
        $(this).removeClass('btn-secondary').addClass('btn-danger');
        $('#property_purpose').val($(this).attr('data-id'));
    });
    ///////////////////////////////////////


    $('#submit_inquiry_form').on('submit', function(event) {
        event.preventDefault();
        $('#submit_inquiry_form button').prop('disabled', 'disabled');
        var formData = $(this).serialize();
        var form_action = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url: form_action,
            dataType: 'json',
            data: formData,
            success: function(res) {
                $('#submit_inquiry_form').trigger("reset");
                $('#submit_inquiry_form button').prop('disabled', '');
                Swal.fire({
                    position: 'top-end',
                    icon: res.icon,
                    title: res.title,
                    text: res.text,
                    showConfirmButton: false,
                    timer: 1500
                })

            }
        });
    });
    /////////////////////////////////////////////
    $('#newsletter-form').on('submit', function(event) {
        event.preventDefault();
        $('#newsletter-form button').prop('disabled', 'disabled');
        var formData = $(this).serialize();
        var form_action = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url: form_action,
            dataType: 'json',
            data: formData,
            success: function(res) {
                $('#newsletter-form').trigger("reset");
                $('#newsletter-form').prop('disabled', '');
                Swal.fire({
                    position: 'top-end',
                    icon: res.icon,
                    title: res.title,
                    text: res.text,
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
    });
    // /////////////////////////////////

    function fillTelephoneInput(val) {
        store = val.value;
        $('#telephoneInput').val("+" + store);
    }

    


    function myFunction() {
        var dots = document.getElementById("dots");
        var moreText = document.getElementById("more");
        var btnText = $(".myBtn");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.html("Read more");
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.html("Read less");
            moreText.style.display = "inline";
        }
    }
</script>


</body>

</html>