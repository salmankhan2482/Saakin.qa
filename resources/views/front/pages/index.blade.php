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

@endsection
