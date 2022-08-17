@extends('front.layouts.main')

@section('content')
    <div class="site-banner" style="background-image: url('{{ asset('assets/images/backgrounds/bg-4.jpg') }}')">
        <div class="container">
            <h1 class="text-center">Saved Searches</h1>
        </div>
    </div>

    <section class="inner-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card mt-3">
                        <div class="card-body">
                            <h4>My Account</h4>
                            <ul class="property-type-list list-unstyled">
                                <li>
                                    <a href="{{ URL::to('profile') }}">
                                        <i class="fa fa-user icon"></i> Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('save-search') }}">
                                        <i class="fas fa-chevron-right"></i>
                                        Saved Search
                                        <span>({{ $count ?? '0' }})</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-chevron-right"></i>
                                        Save Properties
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    @foreach ($searches as $search)
                        <div class="col-sm-12 mt-3">
                            <div class="agency-tile border-bottom">
                                    <a class="agency-tile-title p-3" href="{{ $search->link }}" target="_blank"
                                        title="{{ $search->name }}">
                                        <h6 class="h6">{{ $search->name }}</h6>
                                    </a>
                                <div class="agency-tile-info">
                                    <div class="p-3">
                                        <div class="agency-tile-contact spbwx8 pt-1">
                                            <a class="btn btn-monochrome btn-sm flex-grow-1"
                                                href="{{ route('save-search.destroy', $search->id) }}">
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
            </div>
        </div>
    </section>
    @include('front.pages.include.editSaveSearchModal')
@endsection
<script>
    $(document).ready(function() {

        $('body').on('click', '#editSaveSearchModalLabel', function(event) {

            event.preventDefault();
            var id = $(this).data('id');
            $.get('save-search/' + id + '/edit', function(data) {
                $('#userCrudModal').html("Edit search");
                $('#submit').val("Edit search");
                $('#editSaveSearchModalLabel').modal('show');
                $('#id').val(data.data.id);
                $('#name').val(data.data.name);
            })
        });

    });
</script>
