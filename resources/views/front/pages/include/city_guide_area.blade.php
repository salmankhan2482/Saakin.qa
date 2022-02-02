<div class="trending-places guide_v2 popular-place-wrap v1 pt-50 pb-130">
    <div class="container">
        <div class="section-title text-center">
            <h2>City Guide Area</h2>
            <p class="text-justify">City Guide is a community of property experts that will guide you through the different communities in Qatar, the city is yours to discover. Find everything from restaurants, hotels, schools, parks and much more. Our comprehensive list of things to do all around the city. We make it easy for you to gather all the insights you need to make an informed decision with your next real estate or property hunt.
              </p>

        </div>

        <div class="popular-place-wrap v2">
            <div class="row row-10-padding">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        @foreach($cityGuides as $key=>$cityGuide)
                            @php
                                $total_properties = App\Properties::where('city', $cityGuide->id)->where('status',1)->count();
                            @endphp

                            <div class="@if($key % 3 === 0) col-lg-4 @else col-lg-8 col-md-8 @endif mb-20">
                                <a href="{{ route('cityGuide-detail', $cityGuide->city_slug) }}">
                                    <div class="single-place-wrap text-center">
                                        <div class="single-place-image">

                                            @if( asset('upload/cities/'.$cityGuide->city_image) )
                                            <img src="{{asset('upload/cities/'.$cityGuide->city_image)}}" 
                                                alt="{{$cityGuide->city_image}}" class="ht_1">
                                            @else
                                                <img
                                                    src="{{ URL::asset('assets/images/icon-no-image.svg') }}"
                                                    alt="Image of Property">
                                            @endif
                                        </div>
                                        <div class="single-place-content">
                                            <div class="place-title">{{$cityGuide->name}}</div>
                                            <!-- <p>{{$total_properties}} Properties</p> -->
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>



        <div class="row">

            <div class="col-md-3 text-center mt-2 ml-auto mr-auto">
                <a href="{{url('city-guide')}}" class="btn btn-block v3">See All Our City</a>
            </div>
        </div>
    </div>
</div>