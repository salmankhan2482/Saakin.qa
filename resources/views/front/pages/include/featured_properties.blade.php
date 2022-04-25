
<div class="bg-light py-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="text-center">
					<h2 class="h1 mb-3">Featured Properties</h2>
					<p class="text-justify">Saakin is the fastest-growing real estate directory in Qatar. 
                        You can find featured properties on the website, 
                        and you discover all the updates of the real estate market of Qatar through the listings. 
                        Moreover, the portal has managed an amazing platform to connect buyers and sellers with real estate agencies.
						<span id="dots">...</span>
						<span id="more" style="display: none">
							We respond to you quickly to connect with the agents to provide you with the best properties. 
                            You find properties for Sale and Rent on the website, 
                            and you get multiple choices to have the selling and buying properties in Qatar. 
                            Whether you are searching for apartments for living or commercial properties for investment purposes, 
                            we help you with fast assistance. Saakin inc tries its best to bring you the most desirable and ideal property. 
                            You can have information on the specifications of the featured properties and prices through our portal.
						</span>
						<a class="btn btn-primary btn-sm" href="javascript:void(0)" onclick="myFunction()">Read more</a>
					</p>
				</div>
			</div>
		</div>

		<!-- Add Arrows -->
		<div class="row">
			<div class="col-lg-8">
				<div class="row gy-4 mt-1">
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

@include('front.pages.include.mobileSliderCode')