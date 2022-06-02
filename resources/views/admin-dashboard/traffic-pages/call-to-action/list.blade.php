{{-- Extends layout --}}
@extends('admin-dashboard.layouts.master')

{{-- Content --}}
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Click To Action</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="#" method="GET">
                            <div class="row justify-content-center">
                                {{-- <div class="col-sm-2"></div> --}}
                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label d-flex">From</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="h-100 form-control" name="from"
                                                value="{{ request('from') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label d-flex">To</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="h-100 form-control" name="to"
                                                value="{{ request('to') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-dark btn-sm p-2">
                                        {{ trans('words.search') }}
                                    </button>
                                </div>
                                {{-- <div class="col-sm-2"></div> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Click to Action</h4>
                        <a href="{{ route('dashboard.index') }}">
                            <button type="button" class="btn btn-rounded btn-info"><i class="fa fa-arrow-left"></i>
                                Back</button>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display min-w850">
                                <thead>
                                    <tr>
                                        <th>Property ID</th>
                                        <th>Property Title</th>
                                        <th>Call Now</th>
                                        <th>Email</th>
                                        <th>WhatsaApp</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['clickCounters'] as $i => $click)
                                        <tr>
                                            <td>{{ $click->pid }}</td>
                                            <td>
                                                <a class="property-img" target="_blank"
                                                    href="{{ url(strtolower($click->ppurpose) . '/' . $click->pslug . '/' . $click->pid) }}">
                                                    {!! Str::limit($click->pname, 40, '...') !!}
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
                                <tfoot>
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            {{ $data['clickCounters']->render() }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
