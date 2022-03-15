@extends("front.layouts.main")

@section('content')
    <div class="breadcrumb-section page-title bg-h" style="background-image: url('assets/images/backgrounds/dohacityguide.jpg')">
        <div class="overlay op-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 ml-auto mr-auto text-center">
                    <div class="breadcrumb-menu">
                        <h2>{{trans('words.our_agents')}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <style>
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
       .feat_property .thumb .thmb_cntnt, .properti_city.home6 .thumb .thmb_cntnt {
           bottom: 0;
           left: 10px;
           position: absolute;
           right: 10px;
           top: 10px;
       }
       .feat_property .thumb .thmb_cntnt ul.tag, .properti_city.home6 .thumb .thmb_cntnt ul.tag {
           position: absolute;
           left: 12px;
           top: 10px;
       }
       .mb0 {
           margin-bottom: 0px !important;
       }
       .feat_property .thumb .thmb_cntnt ul.tag li:first-child, .feat_property.home8 ul.tag li:first-child, .properti_city.home6 .thumb .thmb_cntnt ul.tag li:first-child, .feat_property.list .dtls_headr ul.tag li:first-child {
           background-color: rgb(62, 76, 102);
       }
       .feat_property .thumb .thmb_cntnt ul.tag li, .feat_property.home8 ul.tag li, .properti_city.home6 .thumb .thmb_cntnt ul.tag li, .feat_property.list .dtls_headr ul.tag li {
           border-radius: 3px;
           height: 25px;
           line-height: 25px;
           text-align: center;
           width: 75px;
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
           padding: 20px;
       }
       .feat_property .details .tc_content h4 {
           font-size: 18px;
           font-family: "Nunito";
           color: #484848;
           font-weight: bold;
           line-height: 1.2;
       }
       .text-thm {
           color: #ff5a5f !important;
       }
       .feat_property .details .tc_content .prop_details {
           margin-bottom: 0;
       }
       .feat_property .details .tc_content .prop_details li {
           margin-right: 30px;
       }
       .feat_property .details .tc_content .prop_details li a {
           font-size: 14px;
           font-family: "Nunito";
           color: #484848;
           line-height: 1.2;
       }
       .feat_property .details .fp_footer {
           border-top: 1px solid #eeeeee;
           display: inline-block;
           padding: 20px;
           position: relative;
           width: 100%;
       }
       .feat_property .details .fp_footer .fp_meta {
           margin-bottom: 0;
       }
       .mb0 {
           margin-bottom: 0px !important;
       }
       .float-left {
           float: left!important;
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
           font-family: "Nunito";
           color: #777777;
           line-height: 1.2;
       }
   </style>
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="feat_property home7 agency">
                        <div class="thumb">
                            <img class="img-fluid" src="images/agency/1.jpg" alt="1.jpg">
                            
                        </div>
                        <div class="details">
                            <div class="tc_content">
                                <h4>Country House Real Estate</h4>
                                <p class="text-thm">Agent</p>
                                <ul class="prop_details mb0">
                                    <li><a href="#">Office: 134 456 3210</a></li>
                                    <li><a href="#">Mobile: 891 456 9874</a></li>
                                    <li><a href="#">Fax: 342 654 1258</a></li>
                                    <li><a href="#">Email: pakulla@findhouse.com</a></li>
                                </ul>
                            </div>
                            <div class="fp_footer">
                                <ul class="fp_meta float-left mb0">
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-google"></i></a></li>
                                </ul>
                                <div class="fp_pdate float-right text-thm">View My Listings <i class="fa fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="feat_property home7 agency">
                        <div class="thumb">
                            <img class="img-fluid" src="images/agency/2.jpg" alt="2.jpg">
                        </div>
                        <div class="details">
                            <div class="tc_content">
                                <h4>High-Rise Real Estate</h4>
                                <p class="text-thm">Agent</p>
                                <ul class="prop_details mb0">
                                    <li><a href="#">Office: 134 456 3210</a></li>
                                    <li><a href="#">Mobile: 891 456 9874</a></li>
                                    <li><a href="#">Fax: 342 654 1258</a></li>
                                    <li><a href="#">Email: annaharris@findhouse.com</a></li>
                                </ul>
                            </div>
                            <div class="fp_footer">
                                <ul class="fp_meta float-left mb0">
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-google"></i></a></li>
                                </ul>
                                <div class="fp_pdate float-right text-thm">View My Listings <i class="fa fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="feat_property home7 agency">
                        <div class="thumb">
                            <img class="img-fluid" src="images/agency/3.jpg" alt="3.jpg">
                        </div>
                        <div class="details">
                            <div class="tc_content">
                                <h4>Modern House Real estate</h4>
                                <p class="text-thm">Agent</p>
                                <ul class="prop_details mb0">
                                    <li><a href="#">Office: 134 456 3210</a></li>
                                    <li><a href="#">Mobile: 891 456 9874</a></li>
                                    <li><a href="#">Fax: 342 654 1258</a></li>
                                    <li><a href="#">Email: pakulla@findhouse.com</a></li>
                                </ul>
                            </div>
                            <div class="fp_footer">
                                <ul class="fp_meta float-left mb0">
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-google"></i></a></li>
                                </ul>
                                <div class="fp_pdate float-right text-thm">4 years ago</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="feat_property home7 agency">
                        <div class="thumb">
                            <img class="img-fluid" src="images/agency/4.jpg" alt="4.jpg">
                        </div>
                        <div class="details">
                            <div class="tc_content">
                                <h4>Real estate experts</h4>
                                <p class="text-thm">Agent</p>
                                <ul class="prop_details mb0">
                                    <li><a href="#">Office: 134 456 3210</a></li>
                                    <li><a href="#">Mobile: 891 456 9874</a></li>
                                    <li><a href="#">Fax: 342 654 1258</a></li>
                                    <li><a href="#">Email: pakulla@findhouse.com</a></li>
                                </ul>
                            </div>
                            <div class="fp_footer">
                                <ul class="fp_meta float-left mb0">
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-google"></i></a></li>
                                </ul>
                                <div class="fp_pdate float-right text-thm">View My Listings <i class="fa fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="feat_property home7 agency">
                        <div class="thumb">
                            <img class="img-fluid" src="images/agency/5.jpg" alt="5.jpg">
                        </div>
                        <div class="details">
                            <div class="tc_content">
                                <h4>Luxury House Real Estate</h4>
                                <p class="text-thm">Agent</p>
                                <ul class="prop_details mb0">
                                    <li><a href="#">Office: 134 456 3210</a></li>
                                    <li><a href="#">Mobile: 891 456 9874</a></li>
                                    <li><a href="#">Fax: 342 654 1258</a></li>
                                    <li><a href="#">Email: pakulla@findhouse.com</a></li>
                                </ul>
                            </div>
                            <div class="fp_footer">
                                <ul class="fp_meta float-left mb0">
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-google"></i></a></li>
                                </ul>
                                <div class="fp_pdate float-right text-thm">View My Listings <i class="fa fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="feat_property home7 agency">
                        <div class="thumb">
                            <img class="img-fluid" src="images/agency/6.jpg" alt="6.jpg">
                        </div>
                        <div class="details">
                            <div class="tc_content">
                                <h4>James Estate Agents</h4>
                                <p class="text-thm">Agent</p>
                                <ul class="prop_details mb0">
                                    <li><a href="#">Office: 134 456 3210</a></li>
                                    <li><a href="#">Mobile: 891 456 9874</a></li>
                                    <li><a href="#">Fax: 342 654 1258</a></li>
                                    <li><a href="#">Email: pakulla@findhouse.com</a></li>
                                </ul>
                            </div>
                            <div class="fp_footer">
                                <ul class="fp_meta float-left mb0">
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fa fa-google"></i></a></li>
                                </ul>
                                <div class="fp_pdate float-right text-thm">4 years ago</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt20">
                    <div class="mbp_pagination">
                        <ul class="page_navigation">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> <span class="flaticon-left-arrow"></span> Prev</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">29</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><span class="flaticon-right-arrow"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <span class="scrolltotop"><i class="lnr lnr-arrow-up"></i></span> -->
@endsection
