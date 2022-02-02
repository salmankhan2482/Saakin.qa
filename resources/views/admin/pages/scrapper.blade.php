@extends("admin.admin_app")

@section("content")
<div id="main">
	<div class="page-header">
		<h2>Scrapper</h2>
	</div>
	<div class="row">
		<div class="col-md-12">
			{{print_r($response)}}
		</div>
	</div>
</div>
@endsection