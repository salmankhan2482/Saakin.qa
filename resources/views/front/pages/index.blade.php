@extends("front.layouts.main")
@section('type','Real Estate Directory')
@section('content')
    <style>
        #more {display: none;}
        
        .search_live img{
            max-width: 50px;
            height: 50px;
            width: 50px;
        }
           
    </style>
    @include('front.pages.include.search')
    
    <div class="ajaxChange">
        @include('front.pages.include.featured_properties')
    </div>
    
    @include('front.pages.include.city_guide_area')

    <div class="row">
        <div class="col-md-12 text-center">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5375398163072819"
                crossorigin="anonymous"></script>
            <!-- saakin ads -->
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-5375398163072819"
                data-ad-slot="6433115636"
                data-ad-format="auto"
                data-full-width-responsive="true"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
@endsection
