@if(!empty(config('dz.public.global.js')))
	@foreach(config('dz.public.global.js') as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
	@endforeach
@endif

@foreach ($action as $item)
@if(!empty(config('dz.public.pagelevel.js.'.$item)))
	@foreach(config('dz.public.pagelevel.js.'.$item) as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
	@endforeach
@endif
@endforeach

	<!--		<script src="{{ asset('js/custom.min.js') }}" type="text/javascript"></script>
			<script src="{{ asset('js/deznav-init.js') }}" type="text/javascript"></script> -->
<!--	{{-- Education Theme JS --}}
@foreach ($action as $item)
@if(!empty(config('dz.public.education.pagelevel.js.'.$item)))
	@foreach(config('dz.public.education.pagelevel.js.'.$item) as $script)
			<script src="{{ asset($script) }}" type="text/javascript"></script>
	@endforeach
@endif	-->
@endforeach
