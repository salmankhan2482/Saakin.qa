<div class="bg-light py-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="text-center">
                    <h2 class="h3 mb-2">Featured Properties in Qatar</h2>
                    <p class="text-justify">Saakin is the fastest-growing real estate directory in Qatar. You can find featured properties 
                        on our website and discover all the updates on the real estate market in Qatar. Moreover, 
                        our developed dashboard contains a platform to connect property buyers with Qatar's best real estate agencies.
                        <span id="dots">...</span>
                        <span id="more" style="display: none">
                            We respond to customers quickly to help them communicate with top real estate agents in Qatar and provide access to 
                            their high valued properties. Find property in Qatar for Rent and Sale on our website or get various selections to 
                            sell and buy property. Whether you are searching for properties for a living, commercial, or investment purposes, 
                            Saakin helps you with fast assistance. Saakin Inc. is at its best to bring you the most desirable and ideal properties 
                            in Doha, Qatar. Expats can have
                             specific information about any property, area, and all about the State of Qatar using our city guide area and blogs.
                             You can find all types of properties for rent or sale in Qatar with our easy to use faceted search filters.
                        </span>
                        <a class="btn btn-primary btn-sm" href="javascript:void(0)" onclick="myFunction()">Read more</a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Add Arrows -->

        <div class="row gy-4">
            @foreach ($featured_properties as $key => $property)
                    <div class="col-sm-6 col-lg-4">
                        @include('front.pages.include.property_box')
                    </div>
            @endforeach
        </div>

        {{-- <div class="row">
            <div class="col-lg-8">
                
            </div>
            <div class="col-lg-4">
                <div class="row gy-4 mt-1">

                    <div class="col-md-12">
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2421573832685297"
                                                crossorigin="anonymous"></script>
                        <!-- home page listing ads -->
                        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-2421573832685297"
                            data-ad-slot="6731050378" data-ad-format="auto" data-full-width-responsive="true"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                    <div class="col-md-12">
                        <div class="g-ads">
                            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2421573832685297"
                                                        crossorigin="anonymous"></script>
                            <!-- home page listing ads -->
                            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-2421573832685297"
                                data-ad-slot="6731050378" data-ad-format="auto" data-full-width-responsive="true"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row justify-content-center mt-3 mt-md-5">
            <div class="col-md-3">
                <a href="{{ route('featured-properties') }}" class="btn btn-primary w-100">See All Featured
                    Properties</a>
            </div>
        </div>
    </div>
</div>
</div>

@include('front.pages.include.mobileSliderCode')
