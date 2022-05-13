@extends("front.layouts.main")

@if ($blog->meta_title != null)
    @section('title', $blog->meta_title . ' | ' . 'Saakin.qa')
    @section('description', $blog->meta_description)
    @section('keyword', $blog->meta_keywords)
    @section('type', 'article')
    @section('url', url()->current())
    @section('image', asset('upload/blogs/' . $blog->image))
@else
    @section('title', $blog->title . ' | ' . 'Saakin.qa')
    @section('description', Illuminate\Support\Str::limit($blog->description, 170, '...') ?? '')
    @section('keyword', $blog->meta_keywords)
    @section('type', 'article')
    @section('url', url()->current())
    @section('image', asset('upload/blogs/' . $blog->image))
@endif

@section('content')

    {{-- Banner Start --}}
    <div class="site-banner" style="background-image: url('{{ asset('upload/blogs/' . $blog->image) }}')">
        <div class="container">
            <h1 class="text-center">{{ $blog->title }}</h1>
            <div class="text-white fs-sm d-flex justify-content-center spbwx8">
                <span><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></span>
                <span>/</span>
                <span>Blog Details</span>
            </div>
        </div>
    </div>
    {{-- Banner End --}}

    <div class="inner-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="google-ad mb-4">
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2421573832685297"
                                                crossorigin="anonymous"></script>
                        <ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-layout="in-article"
                            data-ad-format="fluid" data-ad-client="ca-pub-2421573832685297" data-ad-slot="7852560352"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                    {{-- <img class="img-fluid" src="{{ asset('upload/blogs/' . $blog->image) }}" alt="{{ $blog->name }}"> --}}
                    {!! $blog->description !!}

                    <div class="mt-4 d-sm-block">
                        <h5 class="border-bottom pb-3 mb-2">Share This Property</h5>
                        <div
                            class="d-flex flex-wrap 
              @if ((new \Jenssegers\Agent\Agent())->isMobile()) text-center justify-content-center 
              @else align-items-center spbwx12 spbwy8 @endif">

                            <div @if ((new \Jenssegers\Agent\Agent())->isMobile()) class="col-5 m-1" @endif>
                                <a href="http://www.facebook.com/sharer.php?u={{ url()->current() }}"
                                    class="btn btn-monochrome share-btn w-100">
                                    <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-color: #4267b2;">
                                        <path
                                            d="M20 10.061C20 4.505 15.523 0 10 0S0 4.505 0 10.061C0 15.083 3.657 19.245 8.438 20v-7.03h-2.54V10.06h2.54V7.845c0-2.522 1.492-3.915 3.777-3.915 1.094 0 2.238.197 2.238.197v2.476h-1.26c-1.243 0-1.63.775-1.63 1.57v1.888h2.773l-.443 2.908h-2.33V20c4.78-.755 8.437-4.917 8.437-9.939">
                                        </path>
                                    </svg>
                                    Facebook
                                </a>
                            </div>

                            <div @if ((new \Jenssegers\Agent\Agent())->isMobile()) class="col-5 m-1" @endif>
                                <a href="https://twitter.com/share?url={{ url()->current() }}"
                                    class="btn btn-monochrome share-btn w-100">
                                    <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-color: #1da1f3;">
                                        <path
                                            d="M20 10c0 5.525-4.475 10-10 10S0 15.525 0 10 4.475 0 10 0s10 4.475 10 10zM7.843 15.79c4.373 0 6.763-4.051 6.763-7.562 0-.116 0-.231-.004-.342a5.228 5.228 0 0 0 1.187-1.377c-.423.21-.882.352-1.365.419.493-.331.868-.85 1.045-1.472a4.519 4.519 0 0 1-1.508.645c-.434-.518-1.05-.838-1.735-.838-1.312 0-2.376 1.19-2.376 2.657 0 .209.02.413.064.606-1.977-.11-3.727-1.169-4.9-2.778a2.91 2.91 0 0 0-.32 1.334c0 .92.419 1.736 1.06 2.21a2.15 2.15 0 0 1-1.075-.33v.032c0 1.29.818 2.359 1.907 2.607a2.136 2.136 0 0 1-1.074.044c.3 1.058 1.178 1.824 2.218 1.846-.813.711-1.839 1.136-2.953 1.136-.192 0-.38-.011-.566-.039a6.13 6.13 0 0 0 3.632 1.201z">
                                        </path>
                                    </svg>
                                    Twitter
                                </a>
                            </div>

                            <div @if ((new \Jenssegers\Agent\Agent())->isMobile()) class="col-5 m-1" @endif>
                                <a href="https://pinterest.com/pin/create/button/?url={{ url()->current() }}"
                                    class="btn btn-monochrome share-btn w-100">
                                    <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-color: #e60019;">
                                        <path
                                            d="M10.008 0C4.481 0 0 4.474 0 9.992c0 4.235 2.636 7.853 6.36 9.309-.091-.79-.166-2.007.032-2.87.181-.781 1.17-4.967 1.17-4.967s-.297-.6-.297-1.48c0-1.39.807-2.426 1.812-2.426.857 0 1.269.641 1.269 1.406 0 .855-.544 2.138-.832 3.33-.239.995.502 1.81 1.483 1.81 1.779 0 3.146-1.875 3.146-4.573 0-2.393-1.721-4.062-4.184-4.062-2.85 0-4.522 2.13-4.522 4.334 0 .855.329 1.776.74 2.278.083.098.092.189.067.287-.074.313-.247.995-.28 1.135-.041.181-.149.222-.338.132-1.252-.584-2.035-2.401-2.035-3.873 0-3.15 2.29-6.045 6.615-6.045 3.468 0 6.17 2.467 6.17 5.773 0 3.446-2.175 6.217-5.19 6.217-1.013 0-1.969-.526-2.29-1.151l-.626 2.377c-.222.871-.832 1.957-1.244 2.623.94.288 1.928.444 2.966.444C15.519 20 20 15.526 20 10.008 20.016 4.474 15.535 0 10.008 0z">
                                        </path>
                                    </svg>
                                    Pinterest
                                </a>
                            </div>

                            <div @if ((new \Jenssegers\Agent\Agent())->isMobile()) class="col-5 m-1" @endif>
                                <a href="https://api.whatsapp.com/send?text={{ url()->current() }}"
                                    class="btn btn-monochrome share-btn w-100">
                                    <svg viewBox="05 06 22 20" class="btn-icon" style="--icon-color: #25d366;">
                                        <path
                                            d=" M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a.63.63 0 0 1-.315-.1c-.802-.402-1.504-.817-2.163-1.447-.545-.516-1.146-1.29-1.46-1.963a.426.426 0 0 1-.073-.215c0-.33.99-.945.99-1.49 0-.143-.73-2.09-.832-2.335-.143-.372-.214-.487-.6-.487-.187 0-.36-.043-.53-.043-.302 0-.53.115-.746.315-.688.645-1.032 1.318-1.06 2.264v.114c-.015.99.472 1.977 1.017 2.78 1.23 1.82 2.506 3.41 4.554 4.34.616.287 2.035.888 2.722.888.817 0 2.15-.515 2.478-1.318.13-.33.244-.73.244-1.088 0-.058 0-.144-.03-.215-.1-.172-2.434-1.39-2.678-1.39zm-2.908 7.593c-1.747 0-3.48-.53-4.942-1.49L7.793 24.41l1.132-3.337a8.955 8.955 0 0 1-1.72-5.272c0-4.955 4.04-8.995 8.997-8.995S25.2 10.845 25.2 15.8c0 4.958-4.04 8.998-8.998 8.998zm0-19.798c-5.96 0-10.8 4.842-10.8 10.8 0 1.964.53 3.898 1.546 5.574L5 27.176l5.974-1.92a10.807 10.807 0 0 0 16.03-9.455c0-5.958-4.842-10.8-10.802-10.8z">
                                        </path>
                                    </svg>
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <h4>Popular Topics</h4>
                            <ul class="property-type-list list-unstyled">
                                @foreach ($categories as $blog_category)
                                    <li>
                                        <a href="{{ route('blog-categories', $blog_category->slug) }}">
                                            <i class="fas fa-chevron-right"></i> {{ $blog_category->category }}
                                            <span>({{ $blog_category->pcount }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <h4 class="card-title">Popular Posts</h4>
                            @foreach ($popularposts as $blog)
                                <div class="d-flex mt-3 position-relative">
                                    <div class="recent-post-img">
                                        <img src="{{ asset('upload/blogs/thumbnail/' . $blog->image) }}"
                                            alt="{{ $blog->title }}">
                                    </div>
                                    <div>
                                        <h6 class="recent-post-title">
                                            <a href="{{ url('blog/' . $blog->slug) }}"
                                                class="line-clamp text-decoration-none stretched-link"
                                                style="--line-clamp: 3;">
                                                {{ $blog->title }}
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <h4 class="card-title">Recent Posts</h4>
                            @foreach ($recentposts as $blog)
                                <div class="d-flex mt-3 position-relative">
                                    <div class="recent-post-img">
                                        <img src="{{ asset('upload/blogs/thumbnail/' . $blog->image) }}"
                                            alt="{{ $blog->title }}">
                                    </div>
                                    <div>
                                        <h6 class="recent-post-title">
                                            <a href="{{ url('blog/' . $blog->slug) }}"
                                                class="line-clamp text-decoration-none stretched-link"
                                                style="--line-clamp: 3;">
                                                {{ $blog->title }}
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <button class="btn btn-primary scrollTopBtn" onclick="scrollToTop()">
            <i class="fas fa-chevron-up"></i>
        </button>
    </div>
@endsection
@push('scripts')

    <script type="text/javascript" src="{{ asset('assets/plugins/slick/slick.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $(document).on("scroll", onScroll);

            //smoothscroll
            $('a[href^="#"]').on('click', function(e) {
                e.preventDefault();

                $(document).off("scroll");

                var navHeight = jQuery('.cityGideNav').outerHeight() + 20;
                var target = this.hash,
                    menu = target;
                $target = $(target);

                $('html, body').stop().animate({
                    scrollTop: jQuery($target).offset().top - navHeight
                }, 500, 'swing', function() {
                    window.location.hash = target;
                    $(document).on("scroll", onScroll);
                });
            });
        });

        function onScroll(event) {
            var scrollPos = $(document).scrollTop();
            var navHeight = jQuery('.cityGideNav').outerHeight() + 20;
            $('#cityGideNav .nav-link').each(function() {
                var currLink = $(this);
                var refElement = $(currLink.attr("href"));
                // console.log(currLink);
                if (refElement.offset().top - navHeight <= scrollPos && refElement.offset().top - navHeight +
                    refElement.height() > scrollPos) {
                    $('#cityGideNav .nav-link').removeClass("active");
                    currLink.addClass("active");
                } else {
                    currLink.removeClass("active");
                }
            });
        }
    </script>
    <script>
        function scrollToTop() {
            $(window).scrollTop(0);
        }

        $(document).ready(function() {

            $(".pro-same-slider").slick({
                arrows: false,
                dots: false,
                autoplay: true,
                autoplaySpeed: 2000,
                slidesToShow: 5,
                slidesToScroll: 5,
                responsive: [{
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });


        });
    </script>


    @section('schema-markup')
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "BlogPosting",
                "mainEntityOfPage": {
                    "@type": "WebPage",
                    "@id": "{{ url('blog/' . $blog->slug) }}"
                },
                "headline": "{{ $blog->title }}",
                "image": "{{ asset('upload/blogs/' . $blog->image) }}",
                "author": {
                    "@type": "Organization",
                    "name": "Admin",
                    "url": "https://www.saakin.qa/upload/logo.png"
                },
                "publisher": {
                    "@type": "Organization",
                    "name": "Saakin Inc",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "https://www.saakin.qa/upload/logo.png"
                    }
                },
                "datePublished": "{{ date('d-m-Y', strtotime($blog->created_at)) }}",
                @if ($blog->updated_at)
                    {{ date('d-m-Y', strtotime($blog->updated_at)) }}@else{{ date('d-m-Y', strtotime($blog->created_at)) }}
                @endif"
            }
        </script>
    @endsection
@endpush
