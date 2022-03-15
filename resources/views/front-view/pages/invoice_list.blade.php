@extends("front.layouts.main")

@section('content')
    <!--Breadcrumb Section-->
    <style>
        .contact-info .contact-info-box .inner-container i {
            width: 120px;
            height: 120px;
            position: absolute;
            left: -60px;
            top: 50%;
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            color: #50AEE6;
            text-align: center;
            line-height: 115px;
            font-size: 2.5em;
            background-color: #ededed;
            border: 2px solid #FFFFFF;
            -webkit-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
            -webkit-box-shadow: 0 0 0 1px #ededed;
            box-shadow: 0 0 0 1px #ededed;
        }

        .contact-info .contact-info-box .inner-container {
            position: relative;
            padding: 20px 40px 20px 90px;
            text-align: center;
            background-color: #fafafa;
            min-height: 80px;
            display: table;
            width: 100%;
        }

        .contact-info .contact-info-box .inner-container .value {
            display: table-cell;
            vertical-align: middle;
            font-family: "Scada", Arial, Helvetica, sans-serif;
        }

        .contact-info .contact-info-box {
            padding-left: 60px;
            padding-right: 30px;
            margin-bottom: 30px;
            float: left;
        }

        .contact-info {
            margin: 30px 0 70px;
        }

        .min_profile {
            padding: 30px 0px;
        }

        .sidebar-left {
            padding-left: 0px;
            padding-right: 40px;
        }

        .sidebar-left .widget.member-card {
            padding-bottom: 45px;
        }

        .sidebar-left .widget.member-card {
            padding-bottom: 45px;
        }

        .member-card {
            background: white;
        }

        .member-card-header {
            color: white;
            background: #50AEE6;
            padding: 0px 20px 20px 20px;
            text-align: center;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        }

        .member-card-header h3 {
            margin-top: 0px;
        }

        .member-card-header h3 {
            font-size: 20px;
            color: white;
        }

        .member-card-avatar {
            display: inline-block;
            border-radius: 0px;
            overflow: hidden;
            border: 5px solid rgba(255, 255, 255, 0.4);
            width: 90px;
            height: 90px;
            margin-top: -30px;
            margin-bottom: 10px;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.16);
            transition: all 0.4s;
        }

        .member-card-content {
            text-align: center;
            position: relative;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
        }

        .member-card-content .hex {
            margin-top: -17px;
            position: absolute;
            margin-left: -45px;
        }

        .member-card-content ul {
            position: relative;
            z-index: 10;
        }

        .member-card-content ul li.active a {
            border-right: 2px solid #50AEE6;
            color: #50AEE6;
            font-weight: 700;
        }

        .member-card-content ul li a {
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            padding: 16px 20px 13px 20px;
            display: block;
            color: #3a464e;
        }

        .member-card-content ul li a:hover {
            background: #deebf2;
        }

        .member-card-content ul li .icon {
            margin-right: 7px;
        }

    </style>

    <style>
        .properties_min {
            padding: 20px 10px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        }

        .table-responsive {
            overflow-x: auto;
            min-height: 0.01%;
        }

        .my-properties-list th {
            font-size: 13px;
            text-align: left;
            padding-left: 15px;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }

        th {
            text-align: left;
        }

        td,
        th {
            padding: 0;
        }

        th {
            display: table-cell;
            vertical-align: inherit;
            font-weight: bold;
            text-align: -internal-center;
        }


        table.my-properties-list {
            width: 100%;
        }

        .my-properties-list tr:first-child {
            height: 50px;
        }

        .my-properties-list tr {
            height: 140px;
            border: none;
            border-bottom: 1px solid #cbdfea;
        }

    </style>

    <div class="breadcrumb-section page-title bg-h"
        style="background-image: url('{{ asset('assets/images/backgrounds/bg-4.jpg') }}')">
        <div class="overlay op-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 ml-auto mr-auto text-center">
                    <div class="breadcrumb-menu">
                        <h2>{{ trans('words.invoice') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <section class="breadcrumb-box" data-parallax="scroll" data-image-src="@if (getcong('title_bg')) {{ URL::asset('upload/'.getcong('title_bg')) }} @else {{ URL::asset('site_assets/img/breadcrumb-bg.jpg') }} @endif">
    <div class="inner-container container">
      <h1>{{trans('words.my_invoice')}}</h1>
      <div class="breadcrumb">
        <ul class="list-inline">
          <li class="home"><a href="{{ URL::to('/') }}">Home</a></li>
          <li><a href="#">{{trans('words.my_invoice')}}</a></li>
        </ul>
      </div>
    </div>
  </section> --}}
    <!--Breadcrumb Section-->
    <div class="container">
        <div class="min_profile">
            <div class="row">
                @include("_particles.sidebar_user")

                <div class="col-lg-9 col-md-9 min_form">
                    @if (Session::has('flash_message'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                            {{ Session::get('flash_message') }}
                        </div>
                    @endif
                    <div class="table-responsive properties_min">
                        <table class="my-properties-list">
                            <tbody>
                                <tr>
                                    <th align="center">{{ trans('words.property') }}</th>
                                    <th align="center">{{ trans('words.transaction_id') }}</th>
                                    <th align="center">{{ trans('words.amount') }}</th>
                                    <th align="center">{{ trans('words.tax') }}</th>
                                    <th align="center">{{ trans('words.total_amount') }}</th>
                                    <th align="center">{{ trans('words.date') }}</th>
                                    <th align="center">{{ trans('words.invoice') }}</th>
                                </tr>


                                @foreach ($transaction as $i => $trans)
                                    <tr>
                                        <td align="center">
                                            {{ \App\Properties::getPropertyInfo($trans->property_id)->property_name }}
                                            For
                                            {{ \App\Properties::getPropertyInfo($trans->property_id)->property_purpose }}
                                        </td>
                                        <td align="center">{{ $trans->payment_id }}</td>
                                        <td align="center">{!! getcong('currency_sign') !!} {{ $trans->payment_amount }}</td>
                                        <td align="center">{!! getcong('currency_sign') !!}{{ $trans->tax_amount }}</td>
                                        <td align="center">{!! getcong('currency_sign') !!}{{ $trans->total_payment_amount }}</td>
                                        <td align="center">{{ date('M,  jS, Y', $trans->date) }}</td>
                                        <td align="center"><a
                                                href="{{ url('user_invoice/' . Crypt::encryptString($trans->id)) }}"
                                                target="_blank" class="btn btn-default btn-rounded"><i
                                                    class="fa fa-eye"></i></a></td>
                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                        @if($transaction->total() > getcong('pagination_limit'))
                            @include('_particles.pagination', ['paginator' => $transaction])
                        @endif
                    </div>



                </div><!-- end col -->
            </div>
        </div>

    </div>


@endsection
