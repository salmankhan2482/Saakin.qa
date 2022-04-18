@extends("front-view.layouts.main")

@if ($blog->meta_title != null)
  @section('title', $blog->meta_title . ' | ' . 'Saakin.qa')
  @section('description', $blog->meta_description)
  @section('keyword', $blog->meta_keywords)
  @section('type', 'article')
  @section('url', url()->current())
  @section('image', asset('upload/blogs/' . $blog->image))
@else
  @section('title', $blog->title . ' | ' . 'Saakin.qa')
  @section('description', Illuminate\Support\Str::limit($blog->description, 170, '...') ?? '')
  @section('keyword', $blog->meta_keywords)
  @section('type', 'article')
  @section('url', url()->current())
  @section('image', asset('upload/blogs/' . $blog->image))
@endif

@section('content')

  {{-- Banner Start --}}
  <div class="site-banner" style="background-image: url('{{ asset('upload/blogs/' . $blog->image) }}')">
    <div class="container">
      <h1 class="text-center">{{ $blog->title }}</h1>
      <div class="text-white fs-sm d-flex justify-content-center spbwx8">
        <span><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></span>
        <span>/</span>
        <span>Blog Details</span>
      </div>
    </div>
  </div>
  {{-- Banner End --}}

  <div class="inner-content">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          {{-- <img class="img-fluid" src="{{ asset('upload/blogs/' . $blog->image) }}" alt="{{ $blog->name }}"> --}}
          {!! $blog->description !!}

          <div class="mt-4 d-sm-block">
            <h5 class="border-bottom pb-3 mb-2">Share This Property</h5>
            <div class="d-flex flex-wrap align-items-center spbwx12 spbwy8">
              <div class="mt-2">
               
              </div>
              <div>
                <a href="http://www.facebook.com/sharer.php?u={{url()->current()}}" class="btn btn-monochrome btn-sm share-btn">
                  <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-color: #4267b2;">
                    <path
                      d="M20 10.061C20 4.505 15.523 0 10 0S0 4.505 0 10.061C0 15.083 3.657 19.245 8.438 20v-7.03h-2.54V10.06h2.54V7.845c0-2.522 1.492-3.915 3.777-3.915 1.094 0 2.238.197 2.238.197v2.476h-1.26c-1.243 0-1.63.775-1.63 1.57v1.888h2.773l-.443 2.908h-2.33V20c4.78-.755 8.437-4.917 8.437-9.939">
                    </path>
                  </svg>
                  Facebook</a>
              </div>
              <div>
                <a href="https://twitter.com/share?url={{url()->current()}}" class="btn btn-monochrome btn-sm share-btn">
                  <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-color: #e60019;">
                    <path
                      d="M10.008 0C4.481 0 0 4.474 0 9.992c0 4.235 2.636 7.853 6.36 9.309-.091-.79-.166-2.007.032-2.87.181-.781 1.17-4.967 1.17-4.967s-.297-.6-.297-1.48c0-1.39.807-2.426 1.812-2.426.857 0 1.269.641 1.269 1.406 0 .855-.544 2.138-.832 3.33-.239.995.502 1.81 1.483 1.81 1.779 0 3.146-1.875 3.146-4.573 0-2.393-1.721-4.062-4.184-4.062-2.85 0-4.522 2.13-4.522 4.334 0 .855.329 1.776.74 2.278.083.098.092.189.067.287-.074.313-.247.995-.28 1.135-.041.181-.149.222-.338.132-1.252-.584-2.035-2.401-2.035-3.873 0-3.15 2.29-6.045 6.615-6.045 3.468 0 6.17 2.467 6.17 5.773 0 3.446-2.175 6.217-5.19 6.217-1.013 0-1.969-.526-2.29-1.151l-.626 2.377c-.222.871-.832 1.957-1.244 2.623.94.288 1.928.444 2.966.444C15.519 20 20 15.526 20 10.008 20.016 4.474 15.535 0 10.008 0z">
                    </path>
                  </svg>
                  Pinterest</a>
              </div>
              <div>
                <a href="https://api.whatsapp.com/send?text={{url()->current()}}" class="btn btn-monochrome btn-sm share-btn">
                  <svg viewBox="0 0 22 20" class="btn-icon" style="--icon-color: #1da1f3;">
                    <path
                      d="M20 10c0 5.525-4.475 10-10 10S0 15.525 0 10 4.475 0 10 0s10 4.475 10 10zM7.843 15.79c4.373 0 6.763-4.051 6.763-7.562 0-.116 0-.231-.004-.342a5.228 5.228 0 0 0 1.187-1.377c-.423.21-.882.352-1.365.419.493-.331.868-.85 1.045-1.472a4.519 4.519 0 0 1-1.508.645c-.434-.518-1.05-.838-1.735-.838-1.312 0-2.376 1.19-2.376 2.657 0 .209.02.413.064.606-1.977-.11-3.727-1.169-4.9-2.778a2.91 2.91 0 0 0-.32 1.334c0 .92.419 1.736 1.06 2.21a2.15 2.15 0 0 1-1.075-.33v.032c0 1.29.818 2.359 1.907 2.607a2.136 2.136 0 0 1-1.074.044c.3 1.058 1.178 1.824 2.218 1.846-.813.711-1.839 1.136-2.953 1.136-.192 0-.38-.011-.566-.039a6.13 6.13 0 0 0 3.632 1.201z">
                    </path>
                  </svg>
                  Twitter</a>
              </div>
              <div>
                <a href="https://pinterest.com/pin/create/button/?url={{url()->current()}}" class="btn btn-monochrome btn-sm share-btn"><svg viewBox="0 0 22 20" class="btn-icon" style="--icon-color: #ef5e4e;">
                    <path
                      d="M10 20C4.477 20 0 15.523 0 10S4.477 0 10 0s10 4.477 10 10-4.477 10-10 10zm5.259-14.966A1.001 1.001 0 0 0 15 5H5c-.09 0-.176.012-.259.034l4.552 4.552a1 1 0 0 0 1.414 0l4.552-4.552zm.707.707l-4.552 4.552a2 2 0 0 1-2.828 0L4.034 5.74C4.012 5.824 4 5.911 4 6v7a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V6c0-.09-.012-.176-.034-.259z">
                    </path>
                  </svg> Email</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mt-2">
          <div class="card">
            <div class="card-body">
              <h4>Popular Topics</h4>
              <ul class="property-type-list list-unstyled">
                @foreach ($categories as $blog_category)
                  <li>
                    <a href="{{ route('blog-categories', $blog_category->slug) }}">
                      <i class="fas fa-chevron-right"></i> {{ $blog_category->category }} <span>({{ $blog_category->pcount }})</span>
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
          </div>

          <div class="card mt-3">
            <div class="card-body">
              <h4 class="card-title">Popular Posts</h4>
              @foreach ($popularposts as $blog)
                <div class="d-flex mt-3 position-relative">
                  <div class="recent-post-img">
                    <img src="{{ asset('upload/blogs/thumbnail/' . $blog->image) }}" alt="{{ $blog->title }}">
                  </div>
                  <div>
                    <h6 class="recent-post-title">
                        <a href="{{ url('blog/' . $blog->slug) }}" class="line-clamp text-decoration-none stretched-link" style="--line-clamp: 3;">
                            {{ $blog->title }}
                        </a>
                    </h6>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          <div class="card mt-3">
            <div class="card-body">
              <h4 class="card-title">Recent Posts</h4>
              @foreach ($recentposts as $blog)
                <div class="d-flex mt-3 position-relative">
                  <div class="recent-post-img">
                    <img src="{{ asset('upload/blogs/thumbnail/' . $blog->image) }}" alt="{{ $blog->title }}">
                  </div>
                  <div>
                    <h6 class="recent-post-title">
                        <a href="{{ url('blog/' . $blog->slug) }}" class="line-clamp text-decoration-none stretched-link" style="--line-clamp: 3;">
                            {{ $blog->title }}
                        </a>
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
@section('schema-markup')
<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BlogPosting",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{url('blog/'.$blog->slug)}}"
      },
      "headline": "{{ $blog->title }}",
      "image": "{{asset('upload/blogs/' . $blog->image)}}",  
      "author": {
        "@type": "Organization",
        "name": "Admin",
        "url": "https://www.saakin.qa/upload/logo.png"
      },  
      "publisher": {
        "@type": "Organization",
        "name": "Saakin Inc",
        "logo": {
          "@type": "ImageObject",
          "url": "https://www.saakin.qa/upload/logo.png"
        }
      },
      "datePublished": "{{ date('d-m-Y',strtotime($blog->created_at)) }}",
      "dateModified": "@if ($blog->updated_at) {{ date('d-m-Y',strtotime($blog->updated_at)) }}@else{{ date('d-m-Y',strtotime($blog->created_at)) }} @endif"
    }
    </script>   
@endsection
