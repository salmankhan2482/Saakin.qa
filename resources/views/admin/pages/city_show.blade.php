@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">

		<h2>Area</h2>
	</div>

    <div class="panel panel-default panel-shadow">
             <div class="panel-body">
                <div class="row">
                    <div class="property-amenities-box topArea_v1 ">
                        <div class="text-center">
                           <h1 class="mb-1 fontfamily">Welcome to {{$cityGuide->name}}</h1>
                        <p>{{$cityGuide->short_description}}</p>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-8 text-left">
                                <h2 class="mb-2 border-bottom pb-2">Key Details</h2>
                                <ul class="property-info_v1">
                                    @if(count($cityGuideDetails) > 0)
                                        @foreach($cityGuideDetails as $cityGuideDetail)
                                            <li>
                                                <strong>{{$cityGuideDetail->title}}</strong>
                                                <p>{{$cityGuideDetail->short_description}}</p>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <div class="col-md-4 text-left">
                                <h2 class="mb-2 border-bottom pb-2">Attributes</h2>
                                  <p class="font-13">{{$cityGuide->attributes}}</p>
                            </div>
                        </div>
                    </div>
                     <div class="property-amenities-box">
            <div class="section-title v1"><h2>Around The Block</h2></div>

            <h5 class="mt-35 w-100 mb-0 d-inline-block">{{$cityGuide->name}}:</h5>
            {{$cityGuide->long_description}}
           
            @if(count($cityGuideDetails) > 0)
                @foreach($cityGuideDetails as $i => $cityGuideDetail)
                    <h5 class="mt-35 w-100 mb-0 d-inline-block">{{($i+1)}}:- {{$cityGuideDetail->title}}</h5>
                    <p>{{$cityGuideDetail->long_description}}</p>

                    <div class="row mb-4">
                        <div class="gal">
                        <div class="col-md-6 text-center mt-4">
                            <img src="{{asset('upload/cities/'.$cityGuideDetail->image1)}}" class="img-fluid" alt="{{ $cityGuide->name.'- image 1' }}">
                        </div>
                        <div class="col-md-6 text-center mt-4">
                            <img src="{{asset('upload/cities/'.$cityGuideDetail->image2)}}" class="img-fluid" alt="{{ $cityGuide->name.'- image 2' }}">
                        </div>
                        <div class="col-md-6 text-center mt-4">
                            <img src="{{asset('upload/cities/'.$cityGuideDetail->image3)}}" class="img-fluid" alt="{{ $cityGuide->name.'- image 3' }}">
                        </div>
                        <div class="col-md-6 text-center mt-4">
                            <img src="{{asset('upload/cities/'.$cityGuideDetail->image4)}}" class="img-fluid" alt="{{ $cityGuide->name.'- image 4' }}">
                        </div>
                        </div>
                    </div>
                @endforeach
            @endif


    </div>
                </div>


            </div>
    </div>
    <div class="clearfix"></div>

</div>
<style>
    .gal {


        -webkit-column-count: 1; /* Chrome, Safari, Opera */
        -moz-column-count: 1; /* Firefox */
        column-count: 1;


    }
    .gal img{ width: 100%; padding: 7px 0;}
    .property-amenities-box {

    border-radius: 5px;
    padding: 30px 35px;

}
.topArea_v1 p {
    font-size: 15px;
}
.property-info_v1 li {
    padding: 5px 0 15px 10px;
    list-style: decimal !important;
    margin-left: 32px;
    font-size: 22px;
    line-height: 22px;
    vertical-align: top;
}
.section-title.v1 {
    text-align: center;
}
</style>



@endsection
