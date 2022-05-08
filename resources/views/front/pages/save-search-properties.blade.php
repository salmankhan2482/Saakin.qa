@extends("front.layouts.main")

@section('content')
    <div class="site-banner" style="background-image: url('{{ asset('assets/images/backgrounds/bg-4.jpg') }}')">
        <div class="container">
            <h1 class="text-center">Change Password</h1>
        </div>
    </div>

    <section class="inner-content">
        <div class="container">
            <div class="d-flex align-items-start">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                        aria-selected="true">
                        Save Searches
                    </button>
                    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        Saved Properties
                    </button>
                </div>

                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        {{--  --}}
      <div class="row">
        @foreach ($searches as $search)
          <div class="col-sm-6 mt-4">
            <div class="agency-tile border-bottom">
                <a class="agency-tile-title p-3" href="{{ $search->link }}">
                    <h4 class="h6">{{ $search->name }}</h4>
                </a>
              <div class="agency-tile-info border-top">
                <div class="p-3">
                  <div class="agency-tile-contact d-flex spbwx8 pt-1">
                    <a class="btn btn-monochrome btn-sm flex-grow-1" href="javascript:void(0)" 
                    data-bs-toggle="modal" data-bs-target="{{ auth()->check() ? '#editSaveSearchModalLabel' : '#user-login-popup' }}">
                      <i class="fa fa-edit"></i>
                      Edit
                    </a>
                    <a class="btn btn-monochrome btn-sm flex-grow-1" href="#">
                      <i class="fa fa-trash"></i>
                      Delete
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      {{--  --}}
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        b
                    </div>

                </div>
            </div>
        </div>
    </section>
    @include('front.pages.include.editSaveSearchModal')
@endsection
