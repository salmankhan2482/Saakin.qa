@extends("admin.admin_app")

@section('content')
    <div id="main">
        <div class="page-header">
            <a href="{{ URL::to('admin/click_counter') }}" class="btn btn-default-light btn-xs"><i
                    class="md md-backspace"></i> {{ trans('words.back') }}</a>
        </div>
        @if (Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ Session::get('flash_message') }}
            </div>
        @endif

        <div class="panel panel-default panel-shadow">
            <div class="panel-body">

                <table id="data-table" class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Property Title</th>
                            <th>Call Now</th>
                            <th>Email</th>
                            <th>WhatsaApp</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($clickCounters as $i => $click)
                            <tr>
                                <td>{{ $click->pid }}</td>
                                <td>
                                    <a class="property-img"
                                        href="{{ url(strtolower($click->ppurpose) . '/' . $click->pslug . '/' . $click->pid) }}"
                                        target="_blank">
                                        {!! \Illuminate\Support\Str::limit($click->pname, 40, '...') !!}
                                    </a>
                                </td>
                                <td>
                                    {{ $click->totalCall }}
                                </td>
                                <td>
                                    {{ $click->totalEmail }}
                                </td>
                                <td>
                                    {{ $click->totalWhatsApp }}
                                </td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                   
                </table>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>


@endsection
@section('scripts-custom')
    <script>
        
    </script>
@endsection
