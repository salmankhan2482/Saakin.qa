@extends("front.layouts.main")
@section('title', 'Saakin.qa Blogs | Qatar #1 Property site')
@section('description', 'Blog Description')
@section('keyword', 'Blog Keyword')
@section('type', 'article')
@section('url', url()->current())
@section('content')

  <div class="site-banner" style="background-image:  url('../assets/images/backgrounds/blogs.jpg')">
    <div class="container">
      <h1 class="text-center">Blog</h1>
      <div class="text-white fs-sm d-flex justify-content-center spbwx8">
        <span><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></span>
        <span>/</span>
        <span>Blogs</span>
      </div>
    </div>
  </div>

  <div class="inner-content">
    <div class="container">
      <div class="card search mb-3 mb-lg-0 d-lg-none">
        <div class="card-body">
          <form action="{{ url('blog') }}" method="GET">
            <div class="input-group">
              <input type="text" name="keyword" id="mobile-keyword" class="form-control" placeholder="Search">
              <button type="submit" class="btn btn-primary search-button"><i class="fa fa-search"></i></button>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8">
          <div class="row gy-4">
            @foreach ($blogs as $blog)
              <div class="col-md-6 d-flex">
                <div class="card agency-tile flex-grow-1">
                  <a class="blog-thumb stretched-link" href="{{ url('blog/' . $blog->slug) }}">
                    <img class="img-fluid" src="{{ asset('upload/blogs/thumbnail/' . $blog->image) }}" alt="{{ $blog->title }}">
                  </a>
                  <div class="card-body">
                    <h5 class="card-title text-truncate">
                      {{ $blog->title }}
                    </h5>
                    <p class="card-text line-clamp">
                      {!! Str::limit(strip_tags($blog->description), 150, '...')  !!}
                    </p>
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
                  @if ($blogs->total() > getcong('pagination_limit'))
                    {{ $blogs->links('front.pages.include.pagination') }}
                  @endif
                </div>
              </div>
            </div>
          </div>
          <!--pagination ends-->
        </div>
        <div class="col-lg-4">
          <div class="card search d-none d-lg-block">
            <div class="card-body">
              <form action="{{ url('blog') }}" method="GET">
                <div class="input-group">
                  <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Search" value="{{ request('keyword') }}">
                  <button type="submit" class="btn btn-primary search-button"><i class="fa fa-search"></i></button>
                </div>
              </form>
            </div>
          </div>
          <div class="card mt-3">
            <div class="card-body">
              <h4 class="card-title">Categories </h4>
              <div class="list-tags d-flex flex-wrap spbwx8">
                @foreach ($categories as $blog_category)
                  <a href="{{ route('blog-categories', $blog_category->slug) }}" class="btn btn-monochrome btn-sm mt-2">
                    {{ $blog_category->category }}
                  </a>
                @endforeach
              </div>
            </div>
          </div>

          <div class="card mt-3">
            <div class="card-body">
              <h4 class="card-title">Popular Posts</h4>
              @foreach ($popularposts as $blog)
                <div class="d-flex mt-3 position-relative">
                  <div class="recent-post-img">
                    <img src="{{ asset('upload/blogs/thumbnail/' . $blog->image) }}" alt="{{ $blog->name }}">
                  </div>
                  <div>
                    <h6 class="recent-post-title"><a href="{{ url('blog/' . $blog->slug) }}" class="line-clamp text-decoration-none stretched-link" style="--line-clamp: 3;">{{ $blog->title }}</a>
                    </h6>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
