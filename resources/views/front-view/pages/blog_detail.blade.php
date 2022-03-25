@extends("front.layouts.main")

@if ($blog->meta_title != null)

    @section('title', $blog->meta_title . ' | ' . 'Saakin.com')
    @section('description', $blog->meta_description)
    @section('keyword', $blog->meta_keywords)
    @section('type', 'article')
    @section('url', url()->current())
    @section('image', asset('upload/blogs/' . $blog->image))

@else

    @section('title', $blog->title . ' | ' . 'Saakin.com')
    @section('description', Illuminate\Support\Str::limit($blog->description, 170, '...') ?? '')
    @section('keyword', $blog->meta_keywords)
    @section('type', 'article')
    @section('url', url()->current())
    @section('image', asset('upload/blogs/' . $blog->image))

@endif

@section('content')
    <!--Breadcrumb section starts-->
    <div class="breadcrumb-section bg-h" style="background-image:  url('../assets/images/backgrounds/bg-5.jpg')">
        <div class="overlay op-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <div class="breadcrumb-menu">
                        <h1>{{ $blog->title }}</h1>
                        <span><a href="{{ url('/') }}">Home</a></span>
                        <span>Blog Details</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Breadcrumb section ends-->
    <!--Blog Details section starts-->
    <div class="blog-area">
        <div class="container">
            <div class="row">
                <!--Blog post starts-->
                <div class="col-xl-8 order-xl-12 order-xl-2 order-1 py-100">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <article class="post-single">
                                    <div class="post-content-wrap">
                                        <div class="post-content">
                                            <div class="post-meta text-center">
                                            </div>
                                            <img 
                                                class="img-fluid" 
                                                src="{{ asset('upload/blogs/' . $blog->image) }}"
                                                alt="{{ $blog->name }}"
                                                >
                                                {!! $blog->description !!}
                                        </div>
                                    </div>
                                </article>


                            </div>
                            {{-- desktop social share links --}}
                            <div class="col-md-12"
                                style="border: none !important; background-color: white !important;">
                                <div class="col-12">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="emailAgentModalLongTitle">Share This Blog</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="list-details-wrap text-center">
                                            <a href="http://www.facebook.com/sharer.php?u={{url()->current()}}"
                                                target="_blank" class="col-2 btn btn-outline">
                                                <img src="https://simplesharebuttons.com/images/somacro/facebook.png"
                                                    class="social" alt="Facebook">
                                            </a>
                                            <!-- copy url -->
                                            <button class="col-2 btn btn-outline" value="copy"
                                                style="background: none !important"
                                                onclick="copyToClipboard('copy_{{ $blog->id }}')">
                                                <img src="{{ asset('upload/copy-icon.png') }}" class="social"
                                                    alt="LinkedIn">
                                            </button>
                                            <!-- Twitter -->
                                            <a href="https://twitter.com/share?url={{url()->current()}}"
                                                target="_blank" class="col-2 btn btn-outline">
                                                <img src="https://simplesharebuttons.com/images/somacro/twitter.png"
                                                    class="social" alt="Twitter">
                                            </a>

                                            <!-- WhatsApp -->
                                            <a href="https://api.whatsapp.com/send?text={{url()->current()}}"
                                                target="_blank" class="col-2 btn btn-outline">
                                                <img src="{{ asset('upload/whatsapp.png') }}" class="social socialw"
                                                    alt="WhatsApp">
                                            </a>

                                            <a href="https://pinterest.com/pin/create/button/?url={{url()->current()}}"
                                                target="_blank" class="col-2 btn">
                                                <img src="https://simplesharebuttons.com/images/somacro/pinterest.png"
                                                    class="social" alt="Pinterest">

                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!--Blog post ends-->
                <!-- Right Sidebar starts-->
                <div class="col-xl-4 order-xl-12 order-xl-1 order-2">
                    <div class="sidebar">
                        <div class="sidebar-right">
                           
                            <div class="widget categories">
                                <h3 class="widget-title">Popular Topic</h3>
                                <ul class="icon">
                                    @foreach ($blog_categories as $blog_category)
                                        <li><a
                                                href="{{ route('blog-categories', $blog_category->slug) }}">{{ $blog_category->category }}</a>
                                            <span>({{ $blog_category->pcount }})</span>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="widget recent">
                                <h3 class="widget-title">Recent Posts</h3>
                                <ul class="post-list">
                                    @foreach ($blogs as $blog)
                                        <li class="row recent-list">
                                            <div class="col-lg-5 col-4">
                                                <div class="entry-img">
                                                    <img src="{{ asset('upload/blogs/thumbnail/' . $blog->image) }}"
                                                        alt="{{ $blog->name }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-7 col-8 no-pad-left">
                                                <div class="entry-text">
                                                    <h4 class="entry-title"><a
                                                            href="{{ url('blog/' . $blog->slug) }}">{{ $blog->title }}</a>
                                                    </h4>
                                                    <div class="property-location">
                                                        {{-- <p>{{date("M d, Y",strtotime($blog->created_at))}}</p> --}}
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
                <!-- Right Sidebar ends -->
            </div>
        </div>
    </div>
@endsection
