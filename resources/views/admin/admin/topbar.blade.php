@if(Auth::user()->usertype=='Agency')
	@php
	$agencyid = Auth::user()->agency_id;
		$ag = \App\Agency::where("id",$agencyid)->first();
		$image_icon = URL::asset('upload/agencies/'.$ag->image);
	@endphp
@else
	@php
		if(!empty(Auth::user()->image_icon))
		{
			$image_icon = URL::asset('upload/members/'.Auth::user()->image_icon.'-s.jpg');
		}
		else
		{
			$image_icon = URL::asset('admin_assets/images/guy.jpg');
		}
	@endphp
@endif
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle visible-xs visible-sm collapsed pull-left" id="showLeftPush">
				<i class="md md-menu"></i>
			</button>
			<a class="navbar-brand" href="{{ URL::to('admin/dashboard') }}">{{getcong('site_name')}}</a>
			<button type="button" class="navbar-toggle pull-right" id="showRightPush">
				<i class="md md-more-vert"></i>
			</button>
		</div>
		<div class="hidden-xs">

			<ul class="nav navbar-nav navbar-right">

				<li>
					<div class="btn-group navbar-btn">
						<a href="{{ URL::to('/') }}" class="btn btn-success" target="_blank"><i class="md md-visibility"></i> {{trans('words.view_site')}}</a>
					</div>
				</li>

				<li>
					<a href="#" class="user" id="showUserPush">
						@if($image_icon)
                            <img src="{{$image_icon}}" width="40" alt="person" class="img-circle">
						@else
							<img src="{{ URL::asset('admin_assets/images/guy.jpg') }}" alt="person" class="img-circle" width="40"/>
						@endif
					</a>
				</li>

			</ul>
		</div>
	</div>
</nav>
