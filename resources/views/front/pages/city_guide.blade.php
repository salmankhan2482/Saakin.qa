@extends("front-view.layouts.main")
@if ($landing_page_content->meta_title !=null)

@section('title',$landing_page_content->meta_title . ' | '.' Saakin.qa')
@section('description',$landing_page_content->meta_description)
@section('keyword',$landing_page_content->meta_keyword)
@section('type','City Guide')
@section('url',url()->current())

@else

@section('title','City Guide | Saakin.qa')
@section('description',$page_des)
@section('type','City Guide')
@section('url',url()->current())

@endif
@section('content')

  <div class="site-banner text-center" style="background-image: url('{{ asset('assets/images/citys/city_guide.jpg') }}')">
    <div class="container">
      <h1>City Guide</h1>
      <div class="text-white">{!! $landing_page_content->page_content !!}</div>
    </div>
  </div>

  <div class="inner-content">
    <div class="container">
      <div class="row gy-4">
        @foreach ($cityGuides as $i => $cityGuide)
          @php
            $for_rent = App\Properties::where('city', $cityGuide->id)
                ->where('property_purpose', 'For Rent')
                ->count();
            $for_sale = App\Properties::where('city', $cityGuide->id)
                ->where('property_purpose', 'For Sale')
                ->count();
          @endphp

          <div class="@if ($i % 4 == 0) col-md-6 @else col-md-3 @endif col-sm-12 mb-20">
            <a href="{{ url('city-guide/' . $cityGuide->city_slug) }}" class="single-place-wrap stretched-link">
              <div class="single-place-image">
                <img src="{{ asset('upload/cities/' . $cityGuide->city_image) }}" alt="{{ $cityGuide->city_image }}">
              </div>
              <div class="single-place-content">
                <div class="place-title">{{ $cityGuide->name }}</div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection


@push('styles')
  <style>
    @media (min-width: 768px) {
      .single-place-wrap {
        --box-height: 350px;
      }
    }

  </style>
@endpush
