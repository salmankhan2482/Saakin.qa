@extends("front-view.layouts.main")

@if ($landing_page_content->meta_title != null)
  @section('title', $landing_page_content->meta_title . ' | ' . ' Saakin.qa')
  @section('description', $landing_page_content->meta_description)
  @section('keyword', $landing_page_content->meta_keyword)
  @section('type', 'Real Estate Agency')
  @section('url', url()->current())
@else
  @section('title', 'Real Estate Agencies in Qatar | Saakin.qa')
  @section('description', $page_des)
  @section('type', 'Real Estate Agency')
  @section('url', url()->current())
@endif

@section('content')

  <div class="site-banner" style="background-image: url('assets/images/backgrounds/agencies.jpg')">
    <div class="container">
      <h1 class="text-center">Real Estate Agencies in Qatar</h1>
      <form action="{{ url('agencies') }}" class="" method="post" style="max-width: ">
        @csrf
        <div class="d-flex spbwx8 mt-4 mx-auto @if ((new \Jenssegers\Agent\Agent())->isMobile()) p-2 bg-white rounded @endif" style="max-width: 820px;">
          <div class="input-group-overlay input-search country-list-wrap">
            <div class="input-group-prepend-overlay">
              <span class="input-group-text" id="keyword"><i class="fa fa-search"></i></span>
            </div>
            <input class="form-control prepended-form-control typeahead" type="text" name="keyword" id="keyword" autocomplete="off" placeholder="Enter Agent or Company Name...">
            <div class="resulted-search country-list scroll-y"></div>
          </div>
          <div class="">
            <button type="submit" class="btn btn-primary">
              @if ((new \Jenssegers\Agent\Agent())->isMobile())
                <i class="fa fa-search"></i>
              @else
                Search
              @endif
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="inner-content">
    <div class="container">
      <div class="row align-items-center mb-3 mb-md-4 fs-sm">
        <div class="col-sm-4 col-md-6">
          <h6 class="mb-sm-0">Companies Found</h6>
        </div>
        <div class="col-sm-8 col-md-6">
          <form method="POST" action="{{ url('real-estate-agencies') }}" id="sortForm">
            @csrf
            <div class="row gx-2 align-items-center">
              <label class="col-sm-4 col-md-6 text-sm-end mb-2 fw-500">
                Sort by
              </label>
              <div class="col-sm-8 col-md-6">
                <select class="form-control" name="sortSelect" onchange="FormSubmit(this);">
                  <option value="sortByNumber" {{ request('sortSelect') == 'sortByNumber' ? 'selected' : '' }}>
                    Number of Properties
                  </option>
                  <option value="sortByName" {{ request('sortSelect') == 'sortByName' ? 'selected' : '' }}>
                    Name
                  </option>
                </select>
              </div>
            </div>
          </form>
        </div>
      </div>

      {{--  --}}
      <div class="row gy-3 gy-md-4">
        @foreach ($agencies as $agency)
          <div class="col-sm-6 col-lg-4 col-xxl-3">
            <div class="agency-tile">
              <a class="agency-tile-img border-bottom" href="{{ route('agency_detail', [Str::slug($agency->name),$agency->id] ) }}">
                <img src="{{ asset('/upload/agencies/' . $agency->image) }}" alt="{{ $agency->name }}">
              </a>
              <div class="agency-tile-info">
                <div class="p-3">
                  <a class="agency-tile-title" href="{{ route('agency_detail', [Str::slug($agency->name),$agency->id] ) }}">
                    <h4 class="h6 text-truncate">{{ $agency->name }}</h4>
                  </a>
                  @if (!empty($agency->whatsapp))

                  <div class="agency-tile-contact d-flex spbwx8 pt-1">
                    <a class="btn btn-monochrome btn-sm flex-grow-1" href="tel:{{ $agency->phone }}">
                      <i class="fa fa-phone-alt"></i>
                      Call
                    </a>
                    <a class="btn btn-monochrome btn-sm flex-grow-1" href="mailto:{{ $agency->email }}">
                      <i class="fa fa-envelope"></i>
                      Email
                    </a>
                    <a class="btn btn-monochrome btn-sm flex-grow-1" href="https://api.whatsapp.com/send?phone={{ $agency->whatsapp }}&text=Hi%21%20,"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                  </div>
                  @else

                  <div class="agency-tile-contact d-flex spbwx8 pt-1">
                    <a class="btn btn-monochrome btn-sm flex-grow-1" href="tel:{{ $agency->phone }}">
                      <i class="fa fa-phone-alt"></i>
                      Call
                    </a>
                    <a class="btn btn-monochrome btn-sm flex-grow-1" href="mailto:{{ $agency->email }}">
                      <i class="fa fa-envelope"></i>
                      Email
                    </a>
                   </div>
                      
                  @endif
                  {{--  --}}
                </div>

                <div class="d-flex item-separator border-top p-3">
                  <div class="flex-grow-1 text-center">
                    <strong>{{ count(App\Properties::where('status', '1')->where('property_purpose', 'Rent')->where('agency_id', $agency->id)->get()) }}</strong>
                    <span class="d-block fs-sm" style="--bs-body-font-size: 10px;">For Rent</span>
                  </div>
                  <div class="flex-grow-1 text-center">
                    <strong>{{ count(App\Properties::where('status', '1')->where('property_purpose', 'Sale')->where('agency_id', $agency->id)->get()) }}</strong>
                    <span class="d-block fs-sm" style="--bs-body-font-size: 10px;">For Sale</span>
                  </div>
                </div>
              </div>

              <div class="agency-tile-footer px-3 py-2 d-flex border-top">
                <div class="d-flex align-item-center spbwx8">
                  @php
                    $agency_user = App\User::where('agency_id', $agency->id)
                        ->where('usertype', 'Agency')
                        ->first();
                  @endphp
                  @if (!empty($agency_user->facebook))
                    <a target="_blank" href="{{ $agency_user->facebook }}">
                      <i class="fab fa-facebook-f"></i>
                    </a>
                  @endif
                  @if (!empty($agency_user->twitter))
                    <a target="_blank" href="{{ $agency_user->twitter }}">
                      <i class="fab fa-twitter"></i>
                    </a>
                  @endif
                  @if (!empty($agency_user->instagram))
                    <a target="_blank" href="{{ $agency_user->instagram }}">
                      <i class="fab fa-instagram"></i>
                    </a>
                  @endif

                </div>
                <div class="">
                  <a class="d-inline-flex align-items-center spbwx4" href="{{ url('agency/' . Str::slug($agency->name, '-') . '/' . $agency->id) }}">
                    <span class="lh-1">View My Listings</span>
                    <i class="fa fa-angle-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      {{--  --}}

      @if ($agencies->total() > getcong('pagination_limit'))
        {{ $agencies->appends(request()->except(['page', '_token']))->links('front-view.pages.include.pagination') }}
      @endif

      {{--  --}}

      @if ($agencies->onFirstPage())
        <div class="container">
          <div class="meta-paragraph-container">
            {!! $landing_page_content->page_content !!}
          </div>
        </div>
      @endif

    </div>
  </div>

  {{-- <span class="scrolltotop"><i class="lnr lnr-arrow-up"></i></span> --}}
@endsection


@push('styles')
@endpush

@push('scripts')
<script type="text/javascript">

    function FormSubmit(coming) {
        document.getElementById('sortForm').submit();
    }

    $(".typeahead").on('keyup', function(){
        $(".resulted-search").html('');
        var value = $(this).val();
        
        var path = "{{ url('autocomplete/agencies') }}";
        
        $.ajax({
            url: path,
            type: "GET",
            data: {
                'keyword': value,
            },
            success: function(data) {
                $('.resulted-search').html(data);
            }
        }) //ajax call ends
    })
    
    $(document).on('click', '.select-agency', function() {
        var value = $(this).text();
        $('.desktop-search-li').css('display', 'none');
        $('.typeahead').val(value);
    });

    </script>
@endpush
