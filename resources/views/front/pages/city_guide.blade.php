@extends("front.layouts.main")
@if ($landing_page_content->meta_title !=null)

@section('title',$landing_page_content->meta_title . ' | '.' saakin.qa')
@section('description',$landing_page_content->meta_description)
@section('keyword',$landing_page_content->meta_keyword)
@section('type','City Guide')
@section('url',url()->current())

@else

@section('title','City Guide | saakin.qa')
@section('description',$page_des)
@section('type','City Guide')
@section('url',url()->current())

@endif

@section('content')
    <div class="breadcrumb-section page-title bg-h" style="background-image: url('{{asset('assets/images/citys/city_guide.jpg')}}')">
        <div class="overlay op-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 ml-auto mr-auto text-center">
                    <div class="breadcrumb-menu">
                        <h1>City Guide</h1>
                        <p>{!! $landing_page_content->page_content !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="property-place citys_guide pt-60 pb-80">
        <div class="popular-place-wrap v2">
            <div class="container">
                <div class="row row-10-padding">

                    @foreach($cityGuides as $i => $cityGuide)
                        @php
                            $for_rent = App\Properties::where('city', $cityGuide->id)->where('property_purpose', 'For Rent')->count();
                            $for_sale = App\Properties::where('city', $cityGuide->id)->where('property_purpose', 'For Sale')->count();
                        @endphp

                        @if($i%4==0)
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-20">
                                <a href="{{url('city-guide/'.$cityGuide->city_slug)}}">
                                    <div class="single-place-wrap">
                                        <div class="single-place-image">
                                            <img src="{{asset('upload/cities/'.$cityGuide->city_image)}}" 
                                                alt="{{$cityGuide->city_image}}">
                                        </div>
                                        <div class="single-place-content">
                                            <div class="place-title">{{$cityGuide->name}}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @else
                            <div class="col-lg-3 col-md-3 col-sm-12 mb-20">
                                <a href="{{url('city-guide/'.$cityGuide->city_slug)}}">
                                    <div class="single-place-wrap">
                                        <div class="single-place-image">
                                            <img src="{{asset('upload/cities/'.$cityGuide->city_image)}}" 
                                                alt="{{$cityGuide->city_image}}">
                                        </div>
                                        <div class="single-place-content">
                                            <div class="place-title">{{$cityGuide->name}}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
