@extends("front.layouts.main")

@if ($page_info->meta_title !=null)

@section('title',$page_info->meta_title .  '  |  ' . 'Saakin.com')
@section('description',$page_info->meta_description)
@section('keyword',$page_info->meta_keyword)
@section('type','Terms of Use Saakin.com')
@section('url',url()->current())

@else

@section('title',$page_info->title .  '  |  ' . 'Saakin.com')
@section('description',$page_info->page_content)
@section('type','Terms of Use Saakin.com')
@section('url',url()->current())

@endif

@section('content')

    <div class="breadcrumb-section page-title bg-h" style="background-image: url('@if(getcong('title_bg')) {{ URL::asset('upload/'.getcong('title_bg')) }} @else {{ URL::asset('site_assets/img/breadcrumb-bg.jpg') }} @endif')">
        <div class="overlay op-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 ml-auto mr-auto text-center">
                    <div class="breadcrumb-menu">
                        <h1>{{$page_info->page_title}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Breadcrumb Section-->
    <!-- begin:content -->
    <section class="main-container container" id="video-tour-section">
        {{-- <h2 class="hsq-heading type-1">{{$page_info->page_title}}</h2> --}}
        <div class="content clearfix">
            <div class="desc pt-4 pb-4" style="text-align: justify;color: #333333;">
                {!!stripslashes($page_info->page_content)!!}
            </div>
        </div>
    </section>
    <!-- end:content -->

@endsection
