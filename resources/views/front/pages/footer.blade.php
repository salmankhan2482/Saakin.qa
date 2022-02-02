<span class="scrolltotop"><i class="lnr lnr-arrow-up"></i></span>
</div>
<div class="footer-wrapper v3">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-logo"><a href="index.html">
                            <img src="{{ URL::asset('upload/logo.png') }}" alt="{{getcong('site_name')}}">
                        </a></div>
                </div>
                <div class="col-md-3 ml-auto">
                    <div class="footer-social-wrap">
                        <span style="color:white !important;">Follow us on</span>
                        <ul class="social-buttons style2">
                            <li>
                                <a target="_blank" href="{{getcong('social_facebook')}}">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="{{getcong('social_instagram')}}">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="{{getcong('social_linkedin')}}">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-top-area">
        <div class="container">
            <div class="row nav-folderized">
                <div class="col-lg-3 col-md-12">
                    <div class="footer-content nav">
                        <h2 class="title">{{getcong('footer_widget1_title')}}</h2>
                        <ul class="list res-list">
                            {!! stripslashes(getcong('footer_widget1')) !!}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="footer-content nav">
                        <h2 class="title">{{getcong('footer_widget2_title')}}</h2>
                        <ul class="list res-list">
                            {!! stripslashes(getcong('footer_widget2')) !!}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="footer-content nav">
                        <h2 class="title">{{getcong('footer_widget3_title')}}</h2>
                        <ul class="list res-list">
                            {!! stripslashes(getcong('footer_widget3')) !!}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="footer-content">
                        <h4 class="title">Sign up for the newsletter</h4>
                        <div class="value-input-wrap newsletter">
                            @include('front.pages.include.newsletter')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 offset-md-2">
                    <p> {{getcong('site_copyright')}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<span class="scrolltotop"><i class="lnr lnr-arrow-up"></i></span>
@include('front.modals.userlogin')
@include('front.layouts.jsscripts')
@yield('scripts-custom')

<script>
    $(document).ready(function(){
        $('.property_purpose').click(function(){
            $('.property_purpose').removeClass('btn-danger').removeClass('btn-secondary');
            $('.property_purpose').addClass('btn-secondary');
            $(this).removeClass('btn-secondary').addClass('btn-danger');
            $('#property_purpose').val($(this).attr('data-id'));
        })
    });

    function bedrooms(valx)
    {
        $('.bedrooms').removeClass('btn-secondary');
        $(valx).addClass('btn-secondary');
        var valv = $(valx).html();
        $('#bedrooms').val(valv);
    }

    function bathrooms(valx)
    {
        $('.bathrooms').removeClass('btn-secondary');
        $(valx).addClass('btn-secondary');
        var valv = $(valx).html();
        $('#bathrooms').val(valv);
        
    }    
</script>
</body>
</html>

