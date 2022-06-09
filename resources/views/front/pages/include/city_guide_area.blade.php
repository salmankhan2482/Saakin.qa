<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="text-center">
                    <h2 class="h1 mb-3">City Guide Area</h2>
                    <p class="text-justify">City Guide is a community of property experts that will guide you through
                        the
                        different communities in Qatar, the city is yours to discover. Find everything from restaurants,
                        hotels,
                        schools,
                        parks and much more. Our comprehensive list of things to do all around the city. We make it easy
                        for you to
                        gather
                        all the insights you need to make an informed decision with your next real estate or property
                        hunt.
                    </p>
                </div>
            </div>
        </div>

        <div class="row gy-4 mt-1">
            @foreach ($cityGuides as $key => $cityGuide)
                @php
                    $total_properties = App\Properties::where('city', $cityGuide->id)
                        ->where('status', 1)
                        ->count();
                @endphp

                <div class="@if ($key % 3 === 0) col-md-4 @else col-md-8 @endif mb-20">
                    <a href="{{ route('cityGuide-detail', $cityGuide->city_slug) }}"
                        class="single-place-wrap stretched-link">
                        <div class="single-place-image">
                            @if (asset('upload/cities/' . $cityGuide->city_image))
                                <img src="{{ asset('upload/cities/' . $cityGuide->city_image) }}"
                                    alt="{{ $cityGuide->city_image }}" class="ht_1">
                            @else
                                <img src="{{ URL::asset('assets/images/icon-no-image.svg') }}"
                                    alt="Image of Property">
                            @endif
                        </div>
                        <div class="single-place-content">
                            <div class="place-title">{{ $cityGuide->name }}</div>
                            {{-- <!-- <p>{{$total_properties}} Properties</p> --> --}}
                        </div>
                    </a>
                </div>
            @endforeach

        </div>

        <div class="row justify-content-center mt-3 mt-md-5">
            <div class="col-md-3">
                <a href="{{ url('city-guide') }}" class="btn btn-primary w-100">See All Our City</a>
            </div>
        </div>
        <div class="container">
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2421573832685297"
                        crossorigin="anonymous"></script>
            <ins class="adsbygoogle" style="display:block" data-ad-format="fluid"
                data-ad-layout-key="-6t+ed+2i-1n-4w" data-ad-client="ca-pub-2421573832685297"
                data-ad-slot="4709939966"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
</div>
