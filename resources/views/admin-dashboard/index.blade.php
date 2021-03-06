@extends('admin-dashboard.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-xxl-12">
                <div class="row">
                    <div class="col-xl-6">
                        <a href="{{ url('admin/properties') }}">
                            <div class="card bg-danger property-bx text-white">
                                <div class="card-body">
                                    <div class="media d-sm-flex d-block align-items-center">
                                        <span class="mr-4 d-block mb-sm-0 mb-3">
                                            <svg width="80" height="80" viewBox="0 0 80 80" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M31.8333 79.1667H4.16659C2.33325 79.1667 0.833252 77.6667 0.833252 75.8333V29.8333C0.833252 29 1.16659 28 1.83325 27.5L29.4999 1.66667C30.4999 0.833332 31.8333 0.499999 32.9999 0.999999C34.3333 1.66667 34.9999 2.83333 34.9999 4.16667V76C34.9999 77.6667 33.4999 79.1667 31.8333 79.1667ZM7.33325 72.6667H28.4999V11.6667L7.33325 31.3333V72.6667Z"
                                                    fill="white" />
                                                <path
                                                    d="M75.8333 79.1667H31.6666C29.8333 79.1667 28.3333 77.6667 28.3333 75.8334V36.6667C28.3333 34.8334 29.8333 33.3334 31.6666 33.3334H75.8333C77.6666 33.3334 79.1666 34.8334 79.1666 36.6667V76C79.1666 77.6667 77.6666 79.1667 75.8333 79.1667ZM34.9999 72.6667H72.6666V39.8334H34.9999V72.6667Z"
                                                    fill="white" />
                                                <path
                                                    d="M60.1665 79.1667H47.3332C45.4999 79.1667 43.9999 77.6667 43.9999 75.8334V55.5C43.9999 53.6667 45.4999 52.1667 47.3332 52.1667H60.1665C61.9999 52.1667 63.4999 53.6667 63.4999 55.5V75.8334C63.4999 77.6667 61.9999 79.1667 60.1665 79.1667ZM50.6665 72.6667H56.9999V58.8334H50.6665V72.6667Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <div class="media-body mb-sm-0 mb-3 mr-5">
                                            <h4 class="fs-22 text-white">Total Properties</h4>
                                            <div class="progress mt-3 mb-2" style="height:8px;">
                                                <div class="progress-bar bg-white progress-animated"
                                                    style="width: 100%; height:8px;" role="progressbar">
                                                    <span class="sr-only">100% Complete</span>
                                                </div>
                                            </div>
                                            <span class="fs-14">{{ $data['last_month_properties'] }}
                                                Properties Added Last Month
                                            </span>
                                        </div>
                                        {{-- Use Conditions for conveting Numbers to Abbrivations Ex: 1000 -> 1k --}}
                                        @if ($data['total_properties'] > 0)
                                            @if ($data['total_properties'] <= 999)
                                                <span class="fs-46 font-w500">{{ $data['total_properties'] }}</span>
                                            @elseif ($data['total_properties'] > 999999)
                                                <?php $data['total_properties'] = round($data['total_properties'] / 1000000, 2);
                                                ?>
                                                <span class="fs-46 font-w500">{{ $data['total_properties'] . 'M' }}</span>
                                            @else
                                                <?php
                                                $data['total_properties'] = round($data['total_properties'] / 1000, 2);
                                                ?>
                                                <span class="fs-46 font-w500">{{ $data['total_properties'] }} K</span>
                                            @endif
                                        @else
                                            <span class="fs-46 font-w500">{{ $data['total_properties'] }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <a href="{{ url('admin/properties?purpose=Sale') }}">
                            <div class="widget-stat card bg-primary">
                                <div class="card-body  p-4">
                                    <div class="media">
                                        <span class="mr-3">
                                            <i class="la la-building"></i>
                                        </span>
                                        <div class="media-body text-white">
                                            <p class="mb-1">Properties for Sale</p>
                                            <h3 class="text-white">{{ $data['sale_properties'] }}</h3>
                                            <div class="progress mb-2 bg-secondary">
                                                @if ($data['total_properties'] > 0)
                                                    <div class="progress-bar progress-animated bg-light"
                                                        style="width: {{ $data['total_properties'] > 1 ? ($data['sale_properties'] / $data['total_properties']) * 100 : '' }}%">
                                                    </div>
                                                @endif
                                            </div>
                                            {{-- <small>80% Increase in 20 Days</small> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <a href="{{ url('admin/properties?purpose=Rent') }}">
                            <div class="widget-stat card bg-info">
                                <div class="card-body p-4">
                                    <div class="media">
                                        <span class="mr-3">
                                            <i class="la la-building"></i>
                                        </span>
                                        <div class="media-body text-white">
                                            <p class="mb-1">Properties for Rent</p>
                                            <h3 class="text-white">{{ $data['rent_properties'] }}</h3>
                                            <div class="progress mb-2 bg-primary">
                                                <div class="progress-bar progress-animated bg-light"
                                                    style="width: {{ $data['total_properties'] > 1 ? ($data['rent_properties'] / $data['total_properties']) * 100 : '' }}%">
                                                </div>
                                            </div>
                                            {{-- <small>50% Increase in 25 Days</small> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <a href="{{ route('featuredproperties.index') }}">
                            <div class="widget-stat card bg-success ">
                                <div class="card-body p-4">
                                    <div class="media">
                                        <span class="mr-3">
                                            <i class="la la-star"></i>
                                        </span>
                                        <div class="media-body text-white">
                                            <p class="mb-1">Featured Properties</p>
                                            <h3 class="text-white">{{ $data['featured_properties'] }}</h3>
                                            <div class="progress mb-2 bg-secondary">
                                                <div class="progress-bar progress-animated bg-light"
                                                    style="width: {{ $data['total_properties'] > 1 ? ($data['featured_properties'] / $data['total_properties']) * 100 : '' }}%">
                                                </div>
                                            </div>
                                            {{-- <small>30% Increase in 30 Days</small> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <a href="{{ route('properties.index') }}">
                            <div class="widget-stat card bg-secondary">
                                <div class="card-body p-4">
                                    <div class="media">
                                        <span class="mr-3">
                                            <i class="la la-building"></i>
                                        </span>
                                        <div class="media-body text-white">
                                            <p class="mb-1">Active Properties</p>
                                            <h3 class="text-white">{{ $data['active_properties'] }}</h3>
                                            <div class="progress mb-2 bg-primary">
                                                <div class="progress-bar progress-animated bg-light"
                                                    style="width:{{ $data['total_properties'] > 1 ? ($data['active_properties'] / $data['total_properties']) * 100 : '' }}%">
                                                </div>
                                            </div>
                                            {{-- <small>76% Increase in 20 Days</small> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <a href="{{ route('inactive_properties.index') }}">
                            <div class="widget-stat card bg-warning">
                                <div class="card-body  p-4">
                                    <div class="media">
                                        <span class="mr-3">
                                            <i class="la la-ban"></i>
                                        </span>
                                        <div class="media-body text-white">
                                            <p class="mb-1">Inactive Properties</p>
                                            <h3 class="text-white">{{ $data['inactive_properties'] }}</h3>
                                            <div class="progress mb-2 bg-secondary">
                                                <div class="progress-bar progress-animated bg-light"
                                                    style="width: {{ $data['total_properties'] > 1 ? ($data['inactive_properties'] / $data['total_properties']) * 100 : '' }}%">
                                                </div>
                                            </div>
                                            {{-- <small>80% Increase in 20 Days</small> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <a href="{{ url('/property-reports') }}">
                            <div class="widget-stat card bg-danger">
                                <div class="card-body  p-4">
                                    <div class="media">
                                        <span class="mr-3">
                                            <i class="la la-file"></i>
                                        </span>
                                        <div class="media-body text-white">
                                            <p class="mb-1">Report Properties</p>
                                            <h3 class="text-white">{{ $data['reports'] }}</h3>
                                            <div class="progress mb-2 bg-secondary">
                                                <div class="progress-bar progress-animated bg-light"
                                                    style="width: {{ $data['total_properties'] > 1 ? ($data['reports'] / $data['total_properties']) * 100 : '' }}%">
                                                </div>
                                            </div>
                                            {{-- <small>80% Increase in 20 Days</small> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <a href="{{ route('inquiries') }}">
                            <div class="widget-stat card">
                                <div class="card-body p-4">
                                    <div class="media ai-icon">
                                        <span class="mr-3 bgl-success text-success">
                                            <i class="la la-comments"></i>
                                        </span>
                                        <div class="media-body">
                                            <p class="mb-1">Total Leads</p>
                                            <h4 class="mb-0">{{ $data['inquiries'] }}</h4>
                                            {{-- <span class="badge badge-warning">+3.5%</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <a href="{{ route('propertyVisits_per_month') }}">
                            <div class="widget-stat card">
                                <div class="card-body p-4">
                                    <div class="media ai-icon">
                                        <span class="mr-3 bgl-primary text-primary">
                                            <i class="la la-building"></i>
                                        </span>
                                        <div class="media-body">
                                            <p class="mb-1">Property Visits</p>
                                            <h4 class="mb-0">{{ $data['trafficPerMonth'] }}</h4>
                                            {{-- <span class="badge badge-warning">+3.5%</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <a href="{{ route('callToAction.index') }}">
                            <div class="widget-stat card">
                                <div class="card-body p-4">
                                    <div class="media ai-icon">
                                        <span class="mr-3 bgl-secondary text-secondary">
                                            <i class="la la-building"></i>
                                        </span>
                                        <div class="media-body">
                                            <p class="mb-1">Click to Action</p>
                                            <h4 class="mb-0">{{ $data['clicksPerMonths'] }}</h4>
                                            {{-- <span class="badge badge-warning">+3.5%</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <a href="{{ route('trafficUsers') }}">
                            <div class="widget-stat card">
                                <div class="card-body p-4">
                                    <div class="media ai-icon">
                                        <span class="mr-3 bgl-danger text-danger">
                                            <i class="la la-users"></i>
                                        </span>
                                        <div class="media-body">
                                            <p class="mb-1">Unique Users</p>
                                            <h4 class="mb-0">{{ $data['numberOfUsers'] }}</h4>
                                            {{-- <span class="badge badge-warning">+3.5%</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Leads Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="morris_donught" class="morris_chart_height"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <span style="color: rgb(59, 76, 184)">Click to Action </span> ,
                                    <span style="color: #37D159">Unique Users </span>
                                    Per Month Comparison
                                </h4>
                            </div>
                            <div class="card-body">
                                <div id="simple-line-chart" class="ct-chart ct-golden-section chartlist-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-xxl-12">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h3 class="fs-20 text-black">Monthly Properties Listing</h3>
                    </div>
                    <div class="card-body pt-2 pb-0">
                        <div class="d-flex flex-wrap align-items-center">
                            <span class="fs-36 text-black font-w600 mr-3">{{ $data['propertiesThisYear'] }}</span>
                            <p class="mr-sm-auto mr-3 mb-sm-0 mb-3">Properties Added This Year</p>
                        </div>
                        <div id="chartTimeline"></div>
                    </div>
                </div>
            </div>


            <div class="col-xl-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Click to Action</h4>
                    </div>
                    <div class="card-body">
                        <div id="pie-chart" class="ct-chart ct-golden-section chartlist-chart"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <span style="color: rgb(59, 76, 184)">Emails</span>,
                            <span style="color: #37D159">Calls </span>,
                            <span style="color: #ff9900">WhatsApp </span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div id="stacked-bar-chart" class="ct-chart ct-golden-section chartlist-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h3 class="fs-20 text-black">Properties Map Location</h3>
                        <div class="dropdown ml-auto">
                            <div class="btn-link" data-toggle="dropdown">
                                <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                        <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                        <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                    </g>
                                </svg>

                            </div>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                @foreach ($data['propertyCities'] as $propertyCity)
                                    <p class="mb-2 d-flex align-items-center  fs-16 text-black font-w500">
                                        {{ $propertyCity->name }}
                                        <span class="pull-right text-dark fs-14 ml-2">{{ $propertyCity->pcount }}
                                            Properties</span>
                                    </p>
                                    <div class="progress mb-4" style="height:10px">
                                        <div class="progress-bar bg-primary progress-animated"
                                            style="width: {{ $data['total_properties'] > 1 ? ($propertyCity->pcount / $data['total_properties']) * 100 : '' }}%%">
                                            <span
                                                class="sr-only">{{ $data['total_properties'] > 1 ? ($propertyCity->pcount / $data['total_properties']) * 100 : '' }}%</span>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="col-lg-9">
                                <div id="world-map"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        (function($) {

            var dzChartlist = function() {
                var screenWidth = $(window).width();

                var chartTimeline = function() {

                    var optionsTimeline = {
                        chart: {
                            type: "bar",
                            height: 200,
                            stacked: true,
                            toolbar: {
                                show: false
                            },
                            sparkline: {
                                //enabled: true
                            },
                            offsetX: -10,
                        },
                        series: [{
                            name: "Properties",
                            data: [
                                {{ $data['propertiesPerJan'] }},
                                {{ $data['propertiesPerFeb'] }},
                                {{ $data['propertiesPerMar'] }},
                                {{ $data['propertiesPerApr'] }},
                                {{ $data['propertiesPerMay'] }},
                                {{ $data['propertiesPerJune'] }},
                                {{ $data['propertiesPerJuly'] }},
                                {{ $data['propertiesPerAug'] }},
                                {{ $data['propertiesPerSep'] }},
                                {{ $data['propertiesPerOct'] }},
                                {{ $data['propertiesPerNov'] }},
                                {{ $data['propertiesPerDec'] }},
                            ]

                        }],

                        plotOptions: {
                            bar: {
                                columnWidth: "25%",
                                endingShape: "rounded",
                                startingShape: "rounded",

                                colors: {
                                    backgroundBarColors: ['#f0f0f0', '#f0f0f0', '#f0f0f0', '#f0f0f0',
                                        '#f0f0f0', '#f0f0f0', '#f0f0f0', '#f0f0f0'
                                    ],
                                    backgroundBarOpacity: 1,
                                    backgroundBarRadius: 5,
                                },

                            },
                            distributed: true
                        },
                        colors: ['#3B4CB8'],
                        grid: {
                            show: false,
                        },
                        legend: {
                            show: false
                        },
                        fill: {
                            opacity: 1
                        },
                        dataLabels: {
                            enabled: false,
                            colors: ['#000'],
                            dropShadow: {
                                enabled: true,
                                top: 1,
                                left: 1,
                                blur: 1,
                                opacity: 1
                            }
                        },
                        xaxis: {
                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug',
                                'Sep',
                                'Oct', 'Nov', 'Dec'
                            ],
                            labels: {
                                style: {
                                    colors: '#787878',
                                    fontSize: '13px',
                                    fontFamily: 'poppins',
                                    fontWeight: 100,
                                    cssClass: 'apexcharts-xaxis-label',
                                },
                            },
                            crosshairs: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                        },

                        yaxis: {
                            show: false
                        },

                        tooltip: {
                            x: {
                                show: true
                            }
                        }
                    };
                    var chartTimelineRender = new ApexCharts(document.querySelector("#chartTimeline"),
                        optionsTimeline);
                    chartTimelineRender.render();
                }

                var simpleLineChart = function() {
                    //Simple line chart
                    new Chartist.Line('#simple-line-chart', {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep',
                            'Oct',
                            'Nov', 'Dec'
                        ],
                        series: [
                            [
                                {{ $data['clicksPerJan'] }},
                                {{ $data['clicksPerFeb'] }},
                                {{ $data['clicksPerMar'] }},
                                {{ $data['clicksPerApr'] }},
                                {{ $data['clicksPerMay'] }},
                                {{ $data['clicksPerJune'] }},
                                {{ $data['clicksPerJuly'] }},
                                {{ $data['clicksPerAug'] }},
                                {{ $data['clicksPerSep'] }},
                                {{ $data['clicksPerOct'] }},
                                {{ $data['clicksPerNov'] }},
                                {{ $data['clicksPerDec'] }},
                            ],

                            [
                                {{ $data['usersPerJan'] }},
                                {{ $data['usersPerFeb'] }},
                                {{ $data['usersPerMar'] }},
                                {{ $data['usersPerApr'] }},
                                {{ $data['usersPerMay'] }},
                                {{ $data['usersPerJune'] }},
                                {{ $data['usersPerJuly'] }},
                                {{ $data['usersPerAug'] }},
                                {{ $data['usersPerSep'] }},
                                {{ $data['usersPerOct'] }},
                                {{ $data['usersPerNov'] }},
                                {{ $data['usersPerDec'] }},
                            ],

                        ]
                    }, {
                        fullWidth: true,
                        chartPadding: {
                            right: 40
                        },
                        plugins: [
                            Chartist.plugins.tooltip()
                        ]
                    });

                }

                var donutChart = function() {
                    Morris.Donut({
                        element: 'morris_donught',
                        data: [{
                            label: " Agency Inquiry ",
                            value: {{ $data['Agency Inquiry'] }},
                        }, {
                            label: " Contact Inquiry ",
                            value: {{ $data['Contact Inquiry'] }}
                        }, {
                            label: " Property Inquiry ",
                            value: {{ $data['Property Inquiry'] }}
                        }],
                        resize: true,
                        redraw: true,
                        colors: ['#37d159', 'rgb(59, 76, 184)', '#2b98d6'],
                        responsive: true,
                    });
                }

                var pieChart = function() {
                    //Pie chart with custom labels

                    var data = {
                        labels: <?php echo $pieChart['Label']; ?>,
                        series: <?php echo $pieChart['Data']; ?>
                    };

                    var options = {
                        labelInterpolationFnc: function(value) {
                            return value[0]
                        }
                    };

                    var responsiveOptions = [
                        ['screen and (min-width: 640px)', {
                            chartPadding: 30,
                            donut: true,
                            labelOffset: 100,
                            donutWidth: 40,
                            labelDirection: 'explode',
                            labelInterpolationFnc: function(value) {
                                return value;
                            }
                        }],
                        ['screen and (min-width: 1024px)', {
                            labelOffset: 30,
                            chartPadding: 20
                        }]
                    ];

                    new Chartist.Pie('#pie-chart', data, options, responsiveOptions);

                }

                var stackedBarChart = function() {
                    //Stacked bar chart  
                    new Chartist.Bar('#stacked-bar-chart', {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct',
                            'Nov', 'Dec'
                        ],
                        series: [
                            [
                                {{ $data['EmailPerJan'] }}, {{ $data['EmailPerFeb'] }},
                                {{ $data['EmailPerMar'] }}, {{ $data['EmailPerApr'] }},
                                {{ $data['EmailPerMay'] }}, {{ $data['EmailPerJune'] }},
                                {{ $data['EmailPerJuly'] }}, {{ $data['EmailPerAug'] }},
                                {{ $data['EmailPerSep'] }}, {{ $data['EmailPerOct'] }},
                                {{ $data['EmailPerNov'] }}, {{ $data['EmailPerDec'] }}
                            ],
                            [
                                {{ $data['CallPerJan'] }}, {{ $data['CallPerFeb'] }},
                                {{ $data['CallPerMar'] }}, {{ $data['CallPerApr'] }},
                                {{ $data['CallPerMay'] }}, {{ $data['CallPerJune'] }},
                                {{ $data['CallPerJuly'] }}, {{ $data['CallPerAug'] }},
                                {{ $data['CallPerSep'] }}, {{ $data['CallPerOct'] }},
                                {{ $data['CallPerNov'] }}, {{ $data['CallPerDec'] }}
                            ],
                            [
                                {{ $data['WhatsAppPerJan'] }},
                                {{ $data['WhatsAppPerFeb'] }},
                                {{ $data['WhatsAppPerMar'] }},
                                {{ $data['WhatsAppPerApr'] }},
                                {{ $data['WhatsAppPerMay'] }},
                                {{ $data['WhatsAppPerJune'] }},
                                {{ $data['WhatsAppPerJuly'] }},
                                {{ $data['WhatsAppPerAug'] }},
                                {{ $data['WhatsAppPerSep'] }},
                                {{ $data['WhatsAppPerOct'] }},
                                {{ $data['WhatsAppPerNov'] }}, {{ $data['WhatsAppPerDec'] }}
                            ]
                        ]
                    }, {
                        stackBars: true,
                        axisY: {
                            labelInterpolationFnc: function(value) {
                                return (value / 10) + 'k';
                            }
                        },
                        plugins: [
                            Chartist.plugins.tooltip()
                        ]
                    }).on('draw', function(data) {
                        if (data.type === 'bar') {
                            data.element.attr({
                                style: 'stroke-width: 30px'
                            });
                        }
                    });
                }

                /* Function ============ */
                return {
                    init: function() {},
                    load: function() {
                        chartTimeline();
                        simpleLineChart();
                        donutChart();
                        pieChart();
                        stackedBarChart();
                    },
                    resize: function() {
                        simpleLineChart();
                        pieChart();
                        stackedBarChart();
                    }
                }

            }();

            jQuery(window).on('load', function() {
                setTimeout(function() {
                    dzChartlist.load();
                }, 1000);
            });

            jQuery(window).on('resize', function() {
                dzChartlist.resize();
            });

        })(jQuery);

        $(document).ready(function() {

            $(".chartjs-render-monitor").attr("background-color", "darkblue;");
        });
    </script>
@endsection
