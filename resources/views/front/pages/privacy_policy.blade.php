@extends("front-view.layouts.main")

@if ($page_info->meta_title !=null)

@section('title',$page_info->meta_title .  '  |  ' . 'Saakin.qa')
@section('description',$page_info->meta_description)
@section('keyword',$page_info->meta_keyword)
@section('type','Terms of Use saakin.qa')
@section('url',url()->current())

@else

@section('title',$page_info->title .  '  |  ' . 'Saakin.qa')
@section('description',$page_info->page_content)
@section('type','Terms of Use saakin.qa')
@section('url',url()->current())

@endif

@section('content')
{{-- Banner Start --}}
<div class="site-banner" style="background-image: url('@if(getcong('title_bg')) {{ URL::asset('upload/'.getcong('title_bg')) }} @else {{ URL::asset('site_assets/img/breadcrumb-bg.jpg') }} @endif')">
    <div class="container">
        <h1 class="text-center">{{$page_info->page_title}}</h1>
        <div class="text-white fs-sm d-flex justify-content-center spbwx8">
            <span><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></span>
            <span>/</span>
            <span>{{$page_info->page_title}}</span>
        </div>
    </div>
</div>
{{-- Banner End --}}

<div class="inner-content">
    <div class="container">
        <div class="list-details-wrap mt-20">
            <h4>Description</h4>
            <div class="panel-wrapper">

            <div class="content_description pb-3">
                {!!stripslashes($page_info->page_content)!!}
            </div>

            </div>
        </div>
    </div>
</div>

@endsection
