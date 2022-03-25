@extends("front-view.layouts.main")
@section('type','Real Estate Directory')
@section('content')
{{-- <style>
    #more {
        display: none;
    }

    .search_live img {
        max-width: 50px;
        height: 50px;
        width: 50px;
    }
</style> --}}
@include('front-view.pages.include.search')

<div class="ajaxChange">
    @include('front-view.pages.include.featured_properties')
</div>

@include('front-view.pages.include.city_guide_area')

@endsection