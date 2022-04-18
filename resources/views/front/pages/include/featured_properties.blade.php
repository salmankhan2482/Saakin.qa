<div class="bg-light py-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="text-center">
            <h2 class="h1 mb-3">Featured Properties</h2>
            <p class="text-justify">Saakin is the fastest growing Qatar Real Estate Directory you can find Properties for
              Rent in Qatar. For apartments on rent real estate agents in Qatar bring you the best apartments in Doha,
              <span id="dots">...</span>
              <span id="more" style="display: none">
                The Pearl, West Bay, and properties from all over the country thourgh Qatar property
                directory.
              </span>
              <a class="btn btn-primary btn-sm" href="javascript:void(0)" onclick="myFunction()">Read more</a>
            </p>
          </div>
        </div>
      </div>
  
      <!-- Add Arrows -->
      <div class="row">
        <div class="col-lg-8">
          <div class="row gy-3 gy-md-4 mt-1">
            @foreach ($featured_properties as $property)
              <div class="col-md-6">
                @include('front.pages.include.property_box')
              </div>
            @endforeach
          </div>
        </div>
        <div class="col-lg-4">
          <div></div>
        </div>
      </div>
  
      <div class="row justify-content-center mt-3 mt-md-5">
        <div class="col-md-3">
          <a href="{{ route('featured-properties') }}" class="btn btn-primary w-100">See All Featured Properties</a>
        </div>
      </div>
    </div>
  </div>
  </div>
  