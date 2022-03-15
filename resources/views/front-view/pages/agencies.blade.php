@extends("front.layouts.main")

@if ($landing_page_content->meta_title != null)

    @section('title', $landing_page_content->meta_title . ' | ' . ' Saakin.com')
    @section('description', $landing_page_content->meta_description)
    @section('keyword', $landing_page_content->meta_keyword)
    @section('type', 'Real Estate Agency')
    @section('url', url()->current())

@else

    @section('title', 'Real Estate Agencies in Qatar | Saakin.com')
    @section('description', $page_des)
    @section('type', 'Real Estate Agency')
    @section('url', url()->current())

@endif

@section('content')
    <style>
           .mobile_agent {
            display: none;
        }

        .desktop_agent {
            display: block;
        }

        .feat_property.home7 {
            -webkit-box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.09);
            -moz-box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.09);
            -o-box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.09);
            box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.09);
        }

        .feat_property.home7:hover {
            -webkit-box-shadow: 0px 0px 50px 0px rgba(19, 19, 28, 0.12);
            -moz-box-shadow: 0px 0px 50px 0px rgba(19, 19, 28, 0.12);
            -o-box-shadow: 0px 0px 50px 0px rgba(19, 19, 28, 0.12);
            box-shadow: 0px 0px 50px 0px rgba(19, 19, 28, 0.12);
        }

        .feat_property.home7.style2 {
            border: none;
            overflow: visible;
        }

        .feat_property.home7.style3 {
            box-shadow: none;
        }

        .feat_property.home7.style2:before {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            bottom: -5px;
            content: "";
            left: -5px;
            position: absolute;
            right: -5px;
            top: -5px;
        }

        .feat_property.home7.style3 .details .tc_content {
            padding: 20px 0;
        }

        .feat_property.home7.style3 .thumb,
        .feat_property.home7.style4 .thumb {
            border-radius: 8px;
        }

        .feat_property.home7.style4 .thumb {
            margin: 10px;
            max-height: 215px;
        }

        .feat_property.home7.style4 .thumb .thmb_cntnt.style2 {
            bottom: auto;
        }

        .feat_property.home7.style4 .thumb .thmb_cntnt.style3 {
            top: auto;
        }

        .feat_property.home7 .thumb {
            border-radius: 8px 8px 0 0;
            margin: 0;
            width: 100% !important;
            min-height: 275px !important;
            /*height: 277px !important; */
            overflow: hidden;
        }

        .feat_property.home7.agent .thumb {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 10px;
        }

        .feat_property.home7.agent .thumb img {
            border-radius: 8px;
        }

        .feat_property.home7 .details {
            background-color: #ffffff;
            border-radius: 0 0 8px 8px;
        }

        .feat_property.agent .thumb img,
        .feat_property.agency .thumb img {
            opacity: 1;
            object-fit: cover;
        }

        .feat_property.agent .details .fp_footer .fp_pdate,
        .feat_property.agency .details .fp_footer .fp_pdate {
            margin-top: 6px;
        }

        .feat_property.agency .thumb {
            background-color: #ffffff;
            border-bottom: 1px solid #ebebeb;
        }

        .feat_property.agency .thumb img {
            margin: 0 auto;
            max-height: 275px;
        }

        .feat_property.list.agency .thumb {
            border-bottom: none;
            height: 235px;
            width: 40%;
        }

        .feat_property.list.agency .details {
            border-left: 1px solid #ebebeb;
            padding-left: 10px;
        }

        .feat_property.home7.style4:hover .fp_single_item_slider.owl-carousel.owl-theme.owl-loaded .owl-prev {
            left: 20px;
        }

        .feat_property.home7.style4:hover .fp_single_item_slider.owl-carousel.owl-theme.owl-loaded .owl-next {
            right: 20px;
        }

        .fp_single_item_slider.owl-carousel.owl-theme.owl-loaded .owl-prev {
            background-color: transparent;
            color: #ffffff;
            font-size: 16px;
            left: -30px;
            position: absolute;
            top: 40%;
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        .fp_single_item_slider.owl-carousel.owl-theme.owl-loaded .owl-next {
            background-color: transparent;
            color: #ffffff;
            font-size: 16px;
            right: -30px;
            position: absolute;
            top: 40%;
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        .feat_property .thumb .thmb_cntnt,
        .properti_city.home6 .thumb .thmb_cntnt {
            bottom: 0;
            left: 10px;
            position: absolute;
            right: 10px;
            top: 10px;
        }

        .feat_property .thumb .thmb_cntnt ul.tag,
        .properti_city.home6 .thumb .thmb_cntnt ul.tag {
            position: absolute;
            left: 12px;
            top: 10px;
        }

        .feat_property .thumb .thmb_cntnt ul.tag li,
        .feat_property.home8 ul.tag li,
        .properti_city.home6 .thumb .thmb_cntnt ul.tag li,
        .feat_property.list .dtls_headr ul.tag li {
            border-radius: 3px;
            height: 25px;
            line-height: 25px;
            text-align: center;
            width: 75px;
        }

        .feat_property.home8 ul.tag {
            margin-bottom: 10px;
        }

        .feat_property .thumb .thmb_cntnt ul.tag li:first-child,
        .feat_property.home8 ul.tag li:first-child,
        .properti_city.home6 .thumb .thmb_cntnt ul.tag li:first-child,
        .feat_property.list .dtls_headr ul.tag li:first-child {
            background-color: rgb(62, 76, 102);
        }

        .feat_property .thumb .thmb_cntnt ul.tag li:last-child,
        .feat_property.home8 ul.tag li:last-child,
        .properti_city.home6 .thumb .thmb_cntnt ul.tag li:last-child,
        .feat_property.list .dtls_headr ul.tag li:last-child {
            background-color: #ff5a5f;
            margin-right: 0;
        }

        .feat_property .thumb .thmb_cntnt ul.tag li a,
        .properti_city.home6 .thumb .thmb_cntnt ul.tag li a,
        .feat_property.home8 ul.tag li a,
        .feat_property.list ul.tag li a {
            font-size: 14px;
            color: #fefefe;
            line-height: 1.2;
        }

        .feat_property .thumb .thmb_cntnt .icon {
            bottom: 15px;
            position: absolute;
            right: 20px;
        }

        .feat_property .thumb .thmb_cntnt .icon li {
            border-radius: 8px;
            background-color: rgb(15, 21, 31);
            height: 35px;
            line-height: 35px;
            margin-right: 5px;
            opacity: 0.502;
            text-align: center;
            width: 35px;
        }

        .feat_property.home8 .icon li {
            border-radius: 8px;
            background-color: rgb(247, 247, 247);
            height: 35px;
            line-height: 35px;
            margin-right: 5px;
            opacity: 1;
            text-align: center;
            width: 35px;
        }

        .feat_property.home8 .icon li a {
            color: #484848;
        }

        .feat_property.home8 .details .tc_content {
            display: inline-block;
        }

        .feat_property .details .tc_content ul.icon {
            float: right;
            margin-bottom: 0;
        }

        .feat_property .thumb .thmb_cntnt .icon li a {
            color: #ffffff;
        }

        .feat_property .thumb .thmb_cntnt .icon li:last-child,
        .feat_property.home8 .icon li:last-child {
            margin-right: 0;
        }

        .feat_property .thumb .thmb_cntnt a.fp_price {
            bottom: 15px;
            font-size: 22px;
            color: #ffffff;
            font-weight: bold;
            left: 20px;
            line-height: 1.2;
            position: absolute;
        }

        .feat_property.list .thumb {
            width: 45%;
            margin: 10px;
            position: relative;
        }

        .feat_property.list.style2 .thumb {
            height: auto;
            max-width: -webkit-fill-available;
        }

        .feat_property.list .details {
            width: 70%;
        }

        .feat_property.list .details .fp_footer {
            border: none;
            padding: 0 20px 10px;
        }

        .feat_property.list .details .tc_content {
            padding: 25px 20px 10px;
            position: relative;
        }



        .feat_property.list.favorite_page .thumb {
            height: 126px;
            max-width: 150px;
            margin: 0;
            position: relative;
        }

        .feat_property.list.favorite_page.style2 .details .tc_content p {
            margin-bottom: 0;
        }

        .ht_left_widget ul,
        .ht_right_widget ul {
            margin-bottom: 0;
        }

        .ht_left_widget ul li {
            position: relative;
            vertical-align: middle;
        }

        .ht_right_widget ul li.list-inline-item:nth-child(2) {
            border-left: 1px solid #333333;
            border-right: 1px solid #333333;
            margin-left: 10px;
            padding-right: 15px;
            text-align: center;
        }

        .ht_left_widget ul li.list-inline-item:first-child {
            margin-right: 25px;
        }

        .ht_right_widget ul {
            margin-bottom: 0;
        }

        .ht_right_widget ul li a,
        .ht_right_widget a.btn.cart_btn,
        .header_top_lang_widget ul li .btn.cart_btn {
            color: #a4a4a4;
            font-size: 14px;
        }

        .ht_right_widget ul li a,

        .feat_property.home7 {
            -webkit-box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.09);
            -moz-box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.09);
            -o-box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.09);
            box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.09);
        }

        .feat_property {
            background-color: #ffffff;
            border: 1px solid #ebebeb;
            border-radius: 8px;
            margin-bottom: 30px;
            overflow: hidden;
            position: relative;
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        .feat_property.agency .thumb {
            background-color: #ffffff;
            border-bottom: 1px solid #ebebeb;
        }

        .feat_property.home7 .thumb {
            border-radius: 8px 8px 0 0;
            margin: 0;
        }

        .feat_property .thumb {
            background-color: #1d293e;
            border-radius: 8px;
            display: -webkit-flex;
            display: -moz-flex;
            display: -ms-flex;
            display: -o-flex;
            display: flex;
            overflow: hidden;
            margin: 10px 10px 0 10px;
            position: relative;
        }

        .feat_property.agency .thumb img {
            margin: 0 auto;
        }

        .feat_property .thumb .thmb_cntnt,
        .properti_city.home6 .thumb .thmb_cntnt {
            bottom: 0;
            left: 10px;
            position: absolute;
            right: 10px;
            top: 10px;
        }

        .feat_property .thumb .thmb_cntnt ul.tag,
        .properti_city.home6 .thumb .thmb_cntnt ul.tag {
            position: absolute;
            left: 12px;
            top: 10px;
        }

        .feat_property .thumb .thmb_cntnt ul.tag,
        .properti_city.home6 .thumb .thmb_cntnt ul.tag {
            position: absolute;
            left: 12px;
            top: 10px;
        }

        .feat_property .thumb .thmb_cntnt ul.tag li:last-child,
        .feat_property.home8 ul.tag li:last-child,
        .properti_city.home6 .thumb .thmb_cntnt ul.tag li:last-child,
        .feat_property.list .dtls_headr ul.tag li:last-child {
            background-color: #ff5a5f;
            margin-right: 0;
        }

        .mb0 {
            margin-bottom: 0px !important;
        }


        .list-inline-item:not(:last-child) {
            margin-right: .5rem;
        }


        .feat_property.home7 .details {
            background-color: #ffffff;
            border-radius: 0 0 8px 8px;
        }

        .feat_property .details {
            position: relative;
        }

        .feat_property .details .tc_content {
            padding-top: 10px;
            padding-bottom: 5px;
            padding-right: 20px;
            padding-left: 20px;
        }

        .feat_property .details .tc_content h4 {
            font-size: 18px;
            line-height: 22px;
            color: #484848;
            font-weight: bold;
            margin: 0 0 10px;
            
        }

        .text-thm {
            color: #ff5a5f !important;
        }

        .feat_property .details .tc_content .prop_details {
            margin-bottom: 0;
        }

        .feat_property .details .tc_content .prop_details li {
            margin-right: 30px;
            margin-bottom: 5px;
        }

        .feat_property .details .tc_content .prop_details li a {
            font-size: 14px;
            color: #484848;
            line-height: 1.2;
        }

        .feat_property .details .tc_content .prop_details li a i {
            display: inline-block;
            margin-right: 5px;
            width: 15px;
        }

        .feat_property .details .fp_footer {
            border-top: 1px solid #eeeeee;
            display: inline-block;
            padding: 4px 20px;
            position: relative;
            width: 100%;
        }

        .feat_property .details .fp_footer .fp_meta {
            margin-bottom: 0;
        }

        .float-left {
            float: left !important;
        }

        .feat_property .details .fp_footer .fp_meta li {
            margin-right: 10px;
            vertical-align: middle;
        }

        .list-inline-item:not(:last-child) {
            margin-right: .5rem;
        }

        .list-inline-item {
            display: inline-block;
        }

        .feat_property .details .fp_footer .fp_meta li a {
            font-size: 14px;
            color: #777777;
            line-height: 1.2;
        }

        .feat_property.agent .details .fp_footer .fp_pdate,
        .feat_property.agency .details .fp_footer .fp_pdate {
            margin-top: 6px;
        }

        .feat_property .details .fp_footer .fp_pdate {
            font-size: 14px;
            color: #777777;
            line-height: 1.2;
            margin-top: 12px;
        }

        .text-thm {
            color: #ff5a5f !important;
        }

        .agency .agency-img {
            width: 100%;
            z-index: 9;
        }

        .agency-img {
            position: relative;
        }

        .agency-img img {
            position: relative;
            overflow: hidden;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            width: 100% !important;
            height: 100%;
        }

        .row.feat_property.home7.agency {
            margin: 0;
        }

        @media only screen and (max-width: 767px) {

            .feat_property .details .tc_content h4 {
                height: auto !important;
            }

            .desktop_agent {
                display: none;
            }

            .mobile_agent {
                display: block;
            }
        }

    </style>
    <div class="breadcrumb-section page-title bg-h" style="background-image: url('assets/images/backgrounds/agencies.jpg')">
        <div class="overlay op-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 ml-auto mr-auto text-center">
                    <div class="breadcrumb-menu">
                        <h1 style="color: white">Real Estate Agencies in Qatar</h1>
                    </div>
                </div>
                <div class="col-md-10 col-lg-8  ml-auto mr-auto">

                    <div class="desktop_agent">
                        <form action="{{ url('agencies') }}" class="hero__form v2 filter listing-filter bg-cb"
                            method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12">
                                    <div class="input-search">
                                        <input type="text" class="typeahead" name="keyword" id="keyword"
                                            autocomplete="off" placeholder="Enter Agent or Company Name...">
                                    </div>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 pl-0">
                                    <div class="submit_btn w-100">
                                        <!--<button class="btn v3" type="submit">Search</button>-->
                                        <button type="submit" class="btn btn-block v3">Search</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mobile_agent">
                        <form action="{{ url('agencies') }}" class="hero__form v2 filter listing-filter bg-cb"
                            method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="input-group">
                                        <input type="text" class="typeahead" autocomplete="off" name="keyword"
                                            id="keyword" placeholder="Search Agency"
                                            style="width: 90%;height: 35px;padding:0 0 0 10px">

                                        <div class="input-group-append" style="width: 40px;">
                                            <button class="btn btn-secondary" type="submit" style="width: 100px;">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <section class="pt-50 ">
        <div class="container" 
             style="display: flex; padding-right: 15px !important; padding-left: 15px !important; flex-direction: row; 
             align-items: center; justify-content: space-between; padding: 10px; border-bottom: 0.1rem solid #e2e2e2;"
            >
            <div>
                <p>Companies Found</p>
            </div>
            <div>
                <form method="POST" action="{{url('real-estate-agencies')}}" id="sortForm">
                      @csrf
                      <div class="form-group row">
                        <label for="inputPassword" class="col-sm-3.5 col-form-label">
                            Sort by
                        </label>
                        <div class="col-sm-8.5" style="margin-left: 10px;">
                            <select class="form-control" name="sortSelect" onchange="FormSubmit(this);">
                                
                                <option value="sortByNumber" {{request('sortSelect') == 'sortByNumber' ? 'selected' : '' }}>
                                    Number of Properties
                                </option>
                                <option value="sortByName"  {{ request('sortSelect') == 'sortByName' ? 'selected' : '' }}>
                                    Name
                                </option>
                            </select>
                        </div>
                      </div>
                </form>
            </div>
        </div>

        <div class="container pt-20">
            <div class="row">
                @foreach ($agencies as $agency)

                    <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                        <div class="row feat_property home7 agency">
                            <div class="col-md-12 col-lg-12 col-12 p-0">
                                <div class="thumb">
                                    <a class="agency-img" href="{{ url('agency/' . Str::slug($agency->name, '-') . '/' . $agency->id) }}">
                                        <img class="img-fluid" src="{{ asset('/upload/agencies/' . $agency->image) }}"
                                            alt="{{ $agency->name }}">
                                    </a>

                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-12 p-0">
                                <div class="details">
                                    <div class="tc_content">
                                        <a
                                            href="{{ url('agency/' . Str::slug($agency->name, '-') . '/' . $agency->id) }}">
                                            <h4> {{ substr($agency->name,0,23) }}.. </h4>
                                        </a>
                                        <ul class="prop_details mb0">
                                            <li style="line-height: 19px;">
                                                <a href="call:{{ $agency->phone }}">
                                                    <i class="fa fa-mobile-alt"></i> 
                                                    {{ $agency->phone }}
                                                </a>
                                            </li>
                                            <li style="line-height: 19px;">
                                                <a href="mailto:{{ $agency->email }}">
                                                    <i class="fa fa-envelope"></i>
                                                    {{ substr($agency->email, 0, 18) }}..
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="fp_footer">
                                        <div class="fp_meta">
                                            <div class="row">
                                                <div class="col-6 prop_details" style="border-right:0.1em solid; text-align:center;">
                                                    <strong>{{ count(App\Properties::where('status', '1')->where('property_purpose','Rent')->where('agency_id', $agency->id)->get()) }}</strong><br>
                                           <span style="font-size: 10px;"> For Rent</span>
                                                </div>
                                                <div class="col-6 prop_details" style="text-align:center;"">
                                                    <strong>{{ count(App\Properties::where('status', '1')->where('property_purpose','Sale')->where('agency_id', $agency->id)->get()) }}</strong><br>
                                                    <span style="font-size: 10px;"> For Sale</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fp_footer">
                                       
                                        <ul class="fp_meta float-left mb0">
                                            @php
                                                $agency_user = App\User::where('agency_id', $agency->id)
                                                    ->where('usertype', 'Agency')
                                                    ->first();
                                            @endphp
                                            @if (!empty($agency_user->facebook))
                                                <li class="list-inline-item">
                                                    <a target="_blank" href="{{ $agency_user->facebook }}">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (!empty($agency_user->twitter))
                                                <li class="list-inline-item">
                                                    <a target="_blank" href="{{ $agency_user->twitter }}">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                            @endif
                                            @if (!empty($agency_user->instagram))
                                                <li class="list-inline-item">
                                                    <a target="_blank" href="{{ $agency_user->instagram }}">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                            @endif

                                        </ul>
                                        <div class="fp_pdate float-right text-thm">
                                            <a
                                                href="{{ url('agency/' . Str::slug($agency->name, '-') . '/' . $agency->id) }}">
                                                View My Listings
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="post-nav nav-res pt-20 pb-60">
                <div class="row">
                    <div class="col-md-8 offset-md-2  col-xs-12 ">
                        <div class="page-num text-center">
                            @if($agencies->total() > getcong('pagination_limit'))
                            {{ $agencies->appends(request()->except(['page','_token']))->links('front.pages.include.pagination') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if ($agencies->onFirstPage())
            <div class="container">
                <div class="meta-paragraph-container">
                    {!! $landing_page_content->page_content !!}
                </div>
            </div>
            @endif
            <div class="post-nav nav-res">
                <div class="row">
                    <div class="col-md-8 offset-md-2  col-xs-12 ">
                        <div class="page-num text-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    {{-- <span class="scrolltotop"><i class="lnr lnr-arrow-up"></i></span> --}}
@endsection

@section('scripts-custom')
    <script type="text/javascript">

    function FormSubmit(coming) {
        var value = coming.value;
        $("#sortSelect").val(value);
        document.getElementById('sortForm').submit();
    }

        var path = "{{ url('autocomplete/agencies') }}";
        $('input.typeahead').typeahead({
            source: function(query, process) {
                return $.get(path, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            },
            highlighter: function(item, data) {
                var parts = item.split('#'),
                    html = '<div class="row">';
                html += '<div class="col-md-3 col-3 search_live">';
                html += '<img alt="agency pic" src="{{ URL::asset('upload/agencies/') }}' + '/' + data.img +
                    '"  width="100px;">';
                html += '</div>';
                html += '<div class="col-md-9 col-9 pl-0"><a href="{{ url('agency/') }}' + '/' + data.id +
                    '">';
                html += '<span>' + data.name + '</span>';

                html += '</div>';
                html += '</div>';

                return html;
            }
        });
    </script>
@endsection
