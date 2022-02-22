@extends("front.layouts.main")
@section('title','Saakin.qa Blogs  |  Qatar #1 Property Blog')
@section('description','Blog Description')
@section('keyword','Blog Keyword')
@section('type','article')
@section('url',url()->current())
@section('content')
    <!--Breadcrumb section starts-->
    <div class="breadcrumb-section bg-h" style="background-image:  url('../assets/images/backgrounds/blogs.jpg')">
        <div class="overlay op-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <div class="breadcrumb-menu">
                        <h1>Blogs</h1>
                        <span><a href="{{url('/')}}">Home</a></span>
                        <span>Blogs</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Breadcrumb section ends-->
    <!--Blog section starts-->

    <!--Blog section starts-->
    <div class="blog-area">
        <div class="container">
            <div class="row">

                <!--Blog post starts-->
                <div class="col-xl-8 order-xl-12 order-xl-2 order-1">
                    <div class="blog-section style1 pt-100">
                        <div class="container">
                            <div class="row">
                                @foreach($blogs as $blog)
                                
                                    <div class="col-md-6 col-sm-12">
                                        <div class="card single-blog-item v1 align-items-center">
                                            <a class="agency-img" href="{{url('blog/'.$blog->slug)}}"> 
                                                <img class="img-fluid" src="{{asset('upload/blogs/thumbnail/'.$blog->image)}}" alt="{{$blog->title}}">
                                            </a>
                                            <div class="card-body" style="min-height: 140px !important">                                                
                                                <h4 class="card-title text-center" style="min-height: 112px !important">
                                                    <a href="{{url('blog/'.$blog->slug)}}">
                                                        {{$blog->title}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="bottom-content">
                            
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <!--pagination starts-->
                            <div class="post-nav nav-res pt-20 pb-60">
                                <div class="row">
                                    <div class="col-md-8 offset-md-2  col-xs-12 ">
                                        <div class="page-num text-center">
                                            @if($blogs->total() > getcong('pagination_limit'))
                                                {{ $blogs->links('front.pages.include.pagination') }}
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--pagination ends-->
                        </div>
                    </div>
                </div>
                <!--Blog post ends-->
                <!-- Sidebar starts-->
                <div class="col-xl-4 order-xl-12 order-xl-1 order-2">
                    <div class="sidebar">
                        <div class="sidebar-right">
                            <div class="widget search">
                                <form action="{{url('blogs')}}" method="post">
                                    @csrf
                                    <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Search">
                                    <button type="submit" class="search-button"><i class="lnr lnr-magnifier"></i></button>
                                </form>
                            </div>
                            <div class="widget">
                                <h3 class="widget-title">Categories </h3>
                                <ul class="list-tags">
                                    @foreach ($blog_categories as $blog_category)
                                    <li>
                                        <a href="{{ route('blog-categories', $blog_category->slug) }}" class="btn v2">
                                            {{$blog_category->category}}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                           
                            <div class="widget recent">
                                <h3 class="widget-title">Recent Posts</h3>
                                <ul class="post-list">
                                @foreach($blogs as $blog)
                                    <li class="row recent-list">
                                        <div class="col-lg-5 col-4">
                                            <div class="entry-img">
                                                <img src="{{asset('upload/blogs/thumbnail/'.$blog->image)}}" 
                                                    alt="{{$blog->title}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-8 no-pad-left">
                                            <div class="entry-text">
                                                <h4 class="entry-title"><a href="{{url('blog/'.$blog->slug)}}">{{$blog->title}}</a></h4>
                                                <div class="property-location">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <!--Sidebar ends -->

            </div>
        </div>
    </div>
    
@endsection
