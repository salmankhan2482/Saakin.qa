@extends("front.layouts.main")
@section('type', 'Real Estate Directory')
@section('content')

    @include('front.pages.include.search')

    <div class="ajaxChange">
        @include('front.pages.include.featured_properties')
    </div>

    @include('front.pages.include.city_guide_area')
@endsection

@push('styles')
    <style>
        .g-ads {
            margin-top: 30%;
        }

    </style>
@endpush
