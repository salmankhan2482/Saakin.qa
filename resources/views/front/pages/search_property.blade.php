@extends("front.layouts.main")

@section('content')
    <div class="breadcrumb-section bg-xs" style="background-image: url('assets/images/backgrounds/bg-2.png')">
        <div class="overlay op-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <div class="breadcrumb-menu">
                        <h2>Search Results</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="filter-wrapper style1">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-12">
                    <div class="sidebar-left">
                        <div class="widget filter-widget">

                            <div class="widget-title widget-collapse">
                                <h6>Advance Filters</h6>
                                <a class="ml-auto" data-toggle="collapse" href="#filter-property" role="button" aria-expanded="true" aria-controls="filter-property"> <i class="fas fa-chevron-down"></i> </a>
                            </div>

                            <div class="collapse show" id="filter-property" style="">
                                <form class="hero__form v2 filter">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <select class="hero__form-input form-control custom-select">
                                                <option value="">All Type</option>
                                                <option value="">Villa</option>
                                                <option value="">Apartment Building</option>
                                                <option value="">Commercial</option>
                                                <option value="">Office</option>
                                                <option value="">Residential</option>
                                                <option value="">Shop</option>
                                                <option value="">Apartment</option>
                                            </select>
                                        </div>


                                        <div class="col-12 mb-3">
                                            <select class="hero__form-input  form-control custom-select">
                                                <option>Select Location </option>
                                                <option>New York</option>
                                                <option>California</option>
                                                <option>Washington</option>
                                                <option>New Jersey</option>
                                                <option>Los angeles</option>
                                                <option>Florida</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <select class="hero__form-input  form-control custom-select">
                                                <option>Property Status</option>
                                                <option>Any</option>
                                                <option>For Rent</option>
                                                <option>For Sale</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <select class="hero__form-input  form-control custom-select">
                                                <option>Property Type</option>
                                                <option>Residential</option>
                                                <option>Commercial</option>
                                                <option>Land</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <select class="hero__form-input  form-control custom-select">
                                                <option>Max rooms</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-6 col-12 mb-3">
                                            <select class="hero__form-input  form-control custom-select">
                                                <option>Bed</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-6 col-12 mb-3">
                                            <select class="hero__form-input  form-control custom-select">
                                                <option>Bath</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <div class="filter-sub-area style1">
                                                <div class="filter-title">
                                                    <p>Select Price Range <span><input type="text" id="amount_two"></span></p>
                                                </div>
                                                <div id="slider-range_two" class="price-range mb-30"></div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn v8" type="submit">Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Sidebar ends-->
                </div>
                <div class="col-xl-9 col-lg-12">

                    <div class="property-filter d-sm-flex mt-100">
                        <ul class="property-short list-unstyled d-sm-flex mb-0">
                            <li>
                                <form class="form-inline form-1">
                                    <div class="form-group d-lg-flex d-block">
                                        <label class="justify-content-start">Sort by:</label>
                                        <div class="short-by">
                                            <select class="hero__form-input form-control custom-select">
                                                <option>Price Low to High</option>
                                                <option>Price High to Low</option>
                                                <option>Date new to old</option>
                                                <option>Date Old to New</option>
                                                <option>Date New to Old</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>

                        <ul class="property-view-list nav item-filter-list list-unstyled d-flex mb-0" role="tablist">
                            {{--<li>
                                <form class="form-inline form-2">
                                    <div class="form-group d-lg-flex d-block">
                                        <label class="justify-content-start pr-2">Sort by: </label>
                                        <div class="short-by">
                                            <select class="hero__form-input form-control custom-select">
                                                <option>12</option>
                                                <option>18 </option>
                                                <option>24 </option>
                                                <option>64 </option>
                                                <option>128</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </li>--}}

                            <li><a class="property-list-icon" data-toggle="tab" href="#list-view">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a></li>
                            <li><a class="property-grid-icon active" data-toggle="tab" href="#grid-view">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a></li>
                        </ul>
                    </div>

                    <div class="item-wrapper pt-20">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active property-grid" id="grid-view">
                                <div class="row row-10-padding">

                                    @foreach($properties as $property)
                                        <div class="col-md-6 col-lg-4 col-sm-12" style="cursor: pointer;" onclick="window.location='{{url(strtolower($property->property_purpose).'/'.$property->property_slug.'/'.$property->id)}}';">
                                            <div class="single-property-box">
                                                <div class="property-item">
                                                    <a class="property-img" href="{{url(strtolower($property->property_purpose).'/'.$property->property_slug.'/'.$property->id)}}">
                                                        <img src="{{asset('upload/properties/'.$property->featured_image)}}" 
                                                            alt="{{$property->property_name}}">
                                                    </a>
                                                    <ul class="feature_text">
                                                        <li class="feature_cb"><span> @if($property->featured_property==1) Featured @endif</span></li>
                                                        <li class="feature_or"><span>For {{$property->property_purpose}}</span></li>
                                                    </ul>
                                                     <div class="property-author-wrap">
                                                        <ul class="save-btn">
                                                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Bookmark"><a href="#"><i class="lnr lnr-heart"></i></a></li>
                                                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to Compare"><a href="#"><i class="fas fa-chart-area"></i></a></li>
                                                        </ul>
                                                        <div class="property-author"><span>${{$property->price}}</span></div>
                                                    </div>

                                                </div>
                                                <div class="property-title-box">
                                                    <div class="property-location">
                                                        <i class="fa fa-map-marker-alt"></i>
                                                        <p>{{ $property->address }}, {{ $property->propertyCity->name }}</p>

                                                    </div>
                                                    <ul class="property-feature">
                                                        <li><i class="fas fa-bed"></i><span>{{$property->bedrooms}} </span></li>
                                                        <li><i class="fas fa-bath"></i><span>{{$property->bathrooms}} </span></li>
                                                        <li><i class="fas fa-chart-area"></i><span>{{$property->land_area}} sqft</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                            <div class="tab-pane fade  property-list" id="list-view">
                                @foreach($properties as $property)
                                    <div class="single-property-box">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="property-item">
                                                    <a class="property-img" href="{{url('property/'.$property->property_slug.'/'.$property->id)}}">
                                                        <img src="{{asset('upload/properties/'.$property->featured_image)}}" 
                                                        alt="{{$property->property_name}}">
                                                    </a>
                                                    <ul class="feature_text">
                                                        <li class="feature_cb"><span>@if($property->featured_property==1)  Featured @endif</span></li>
                                                        <li class="feature_or"><span>For {{$property->property_purpose}}</span></li>
                                                    </ul>
                                                    <div class="property-author-wrap">
                                                      
                                                        <ul class="save-btn">
                                                            <li data-toggle="tooltip" data-placement="top" title="Photos"><a href=".html" class="btn-gallery"><i class="lnr lnr-camera"></i></a></li>
                                                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Bookmark"><a href="#"><i class="lnr lnr-heart"></i></a></li>
                                                            <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Add to Compare"><a href="#"><i class="fas fa-chart-area"></i></a></li>
                                                        </ul>
                                                        <div class="hidden photo-gallery">
                                                            <a href="images/single-listing/property_view_1.jpg"></a>
                                                            <a href="images/single-listing/property_view_2.jpg"></a>
                                                            <a href="images/single-listing/property_view_3.jpg"></a>
                                                            <a href="images/single-listing/property_view_4.jpg"></a>
                                                            <a href="images/single-listing/property_view_5.jpg"></a>
                                                            <a href="images/single-listing/property_view_6.jpg"></a>
                                                            <a href="images/single-listing/property_view_7.jpg"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="property-title-box">
                                                    <h4><a href="{{url('property/'.$property->property_slug.'/'.$property->id)}}">{{$property->property_name}}</a></h4>
                                                    <div class="property-location">
                                                        <i class="fa fa-map-marker-alt"></i>
                                                        <p>{{ $property->address }}, {{ $property->propertyCity->name }}</p>
                                                    </div>
                                                    <ul class="property-feature">
                                                        <li> <i class="fas fa-bed"></i>
                                                            <span>{{$property->bedrooms}} Bedrooms</span>
                                                        </li>
                                                        <li> <i class="fas fa-bath"></i>
                                                            <span>{{$property->bathrooms}} Bath</span>
                                                        </li>
                                                        <li> <i class="fas fa-chart-area"></i>
                                                            <span>{{$property->land_area}} sqft</span>
                                                        </li>
                                                        <li> <i class="fas fa-car"></i>
                                                            <span>{{$property->garage}} Garage</span>
                                                        </li>
                                                    </ul>
                                                    <div class="trending-bottom">
                                                        <div class="trend-left float-left" >
                                                            <ul class="product-rating">
                                                                <li><i class="fas fa-star"></i></li>
                                                                <li><i class="fas fa-star"></i></li>
                                                                <li><i class="fas fa-star"></i></li>
                                                                <li><i class="fas fa-star-half-alt"></i></li>
                                                                <li><i class="fas fa-star-half-alt"></i></li>
                                                            </ul>
                                                        </div>
                                                        <a class="trend-right float-right">
                                                            <div class="trend-open">
                                                                <p><span class="per_sale">starts from</span>${{$property->price}}</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!--pagination starts-->
                            {{--<div class="post-nav nav-res pt-20 pb-60">
                                <div class="row">
                                    <div class="col-md-8 offset-md-2  col-xs-12 ">
                                        <div class="page-num text-center">
                                            <ul>
                                                <li class="active"><a href="#">1</a></li>
                                                <li><a href="#">2</a></li>
                                                <li><a href="#">3</a></li>
                                                <li><a href="#">4</a></li>
                                                <li><a href="#"><i class="lnr lnr-chevron-right"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>--}}
                            <!--pagination ends-->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- <span class="scrolltotop"><i class="lnr lnr-arrow-up"></i></span> -->
@endsection
