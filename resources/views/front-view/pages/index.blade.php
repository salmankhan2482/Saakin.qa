@extends("front-view.layouts.main")
@section('type','Real Estate Directory')
@section('content')

@include('front-view.pages.include.search')

<div class="ajaxChange">
    @include('front-view.pages.include.featured_properties')
</div>

@include('front-view.pages.include.city_guide_area')

@endsection