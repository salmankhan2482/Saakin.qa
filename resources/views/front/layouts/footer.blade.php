 {{-- input to store the value and then using for search purpose --}}
 <input type="hidden" id="globalPropertyPurposeValue" value="{{ $request->property_purpose ?? 'Rent' }}">
 <input type="hidden" id="globalPropertyTypeValue" value="{{ request('type')->id ?? '' }}">

<div class="footer-wrapper v3">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-logo"><a href="{{ URL::to('/') }}">
                            <img src="{{ URL::asset('upload/logo.png') }}"
                                alt="{{ getcong('site_name') . 'Logo Pic' }}">
                        </a></div>
                </div>
                <div class="col-md-3 ml-auto">
                    <div class="footer-social-wrap text-white" >
                        <span>Follow us on</span>
                        <ul class="social-buttons style2">
                            <li><a target="_blank" href="{{ getcong('social_facebook') }}">
                                <i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li><a target="_blank" href="{{ getcong('social_instagram') }}">
                                <i class="fab fa-instagram"></i></a></li>
                            <li><a target="_blank" href="{{ getcong('social_linkedin') }}">
                                <i class="fab fa-linkedin-in"></i></a></li>
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
                        <h2 class="title">{{ getcong('footer_widget1_title') }}</h2>
                        <ul class="list res-list">
                            {!! stripslashes(getcong('footer_widget1')) !!}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="footer-content nav">
                        <h2 class="title">{{ getcong('footer_widget2_title') }}</h2>
                        <ul class="list res-list">
                            {!! stripslashes(getcong('footer_widget2')) !!}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="footer-content nav">
                        <h2 class="title">{{ getcong('footer_widget3_title') }}</h2>
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
                    <p style="color: white;"> {!! getcong('site_copyright') !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@include('front.modals.userlogin')
@include('front.pages.include.emailModal')
@include('front.modals.propertyReportModal')
@include('front.layouts.jsscripts')

@yield('scripts-custom')

<script>

    $(document).ready(function(){
        var purposeValue = $("#property_purpose").val();
        $('#globalPropertyPurposeValue').val(purposeValue);

    });

    function setPropertyPurpose(pp) {
            $('#property_purpose').val(pp);
            $('.property_purpose').val(pp);
            $('#globalPropertyPurposeValue').val(pp);
            
            $.ajax({
            url:"select/buyRent/for/search/"+pp,
            success:function(data){
                $('.ajaxChange').html(data);
            }
            });

        }//changing featured products on click of rent and buy on search page
    
        function setPropertyType(pp) {
            $('#globalPropertyTypeValue').val(pp.value);
        }//changing featured products on click of rent and buy on search page


    $(document).on("click", "#emailBtn", function() {
        var image = $(this).attr('data-image');
        $("#modalImg").attr("src", `${image}`);
        // $("#modalImg").attr("src", `upload/properties/thumb_${image}`);
        var title = $(this).attr('data-title');
        $("#modalName").html(title);
        var agent = $(this).attr('data-agent');
        $("#modalAgent").html(agent);
        var broker = $(this).attr('data-broker');
        $("#modalBroker").html(broker);

        var bedroom = $(this).attr('data-bedroom');
        $("#modalBedrooms").html(bedroom);

        var bathroom = $(this).attr('data-bathroom');
        $("#modalBathrooms").html(bathroom);

        var area = $(this).attr('data-area');
        $("#modalSqm").html(area);
    });


    //desktop search
    $('#country').on('keyup', function() {
        var query = $(this).val();
        var purpose = $("#globalPropertyPurposeValue").val();
        var type = $("#globalPropertyTypeValue").val();

        if (query != '') {
            $.ajax({
                url: "{{ route('search-desktop') }}",
                type: "GET",
                data: {
                    'country': query,
                    'purpose': purpose,
                    'type': type
                },
                success: function(data) {
                    $('#country_list').show();
                    $('#country_list').html(data);
                }
            }) //ajax call ends

        } else {
            $('#country_list').hide();
        } //if else ends
    });


    $(document).on('click', '.live-search-li', function() {
        var query = 'Stop';

        var value = $(this).text();
        $('#country').val(value);
        $('#extra_keywords').html($(this).html());
        $('#country_list').html("");
    });


    //mobile serach 
    $('.countryMbl').on('keyup', function() {
        var query = $(this).val();
        var purpose = $("#globalPropertyPurposeValue").val();
        var type = $("#globalPropertyTypeValue").val();

        if (query != '') {
            $.ajax({
                url: "{{ route('search-mobile') }}",
                type: "GET",
                data: {
                    'country': query,
                    'purpose': purpose,
                    'type': type
                },
                success: function(data) {
                    $('#country_list_mbl').show();
                    $('#country_list_mbl').html(data);
                }
            }) //ajax call ends

        } else {
            $('#country_list_mbl').hide();
        } //if else ends
    });


    $(document).on('click', '.live-search-li', function() {
        var query = 'Stop';

        var value = $(this).text();
        $('.countryMbl').val(value);
        $('.extra_keywords').html($(this).html());
        $('#country_list_mbl').html("");
    }); //mbl search



    $('.property_purpose').click(function() {
        $('.property_purpose').removeClass('btn-danger').removeClass('btn-secondary');
        $('.property_purpose').addClass('btn-secondary');
        $(this).removeClass('btn-secondary').addClass('btn-danger');
        $('#property_purpose').val($(this).attr('data-id'));
    });
    ///////////////////////////////////////


    $('#submit_inquiry_form').on('submit', function(event) {
        event.preventDefault();
        $('#submit_inquiry_form button').prop('disabled', 'disabled');
        var formData = $(this).serialize();
        var form_action = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url: form_action,
            dataType: 'json',
            data: formData,
            success: function(res) {
                $('#submit_inquiry_form').trigger("reset");
                $('#submit_inquiry_form button').prop('disabled', '');
                Swal.fire({
                    position: 'top-end',
                    icon: res.icon,
                    title: res.title,
                    text: res.text,
                    showConfirmButton: false,
                    timer: 1500
                })

            }
        });
    });
    /////////////////////////////////////////////
    $('#newsletter-form').on('submit', function(event) {
        event.preventDefault();
        $('#newsletter-form button').prop('disabled', 'disabled');
        var formData = $(this).serialize();
        var form_action = $(this).attr('action');
        $.ajax({
            type: 'POST',
            url: form_action,
            dataType: 'json',
            data: formData,
            success: function(res) {
                $('#newsletter-form').trigger("reset");
                $('#newsletter-form').prop('disabled', '');
                Swal.fire({
                    position: 'top-end',
                    icon: res.icon,
                    title: res.title,
                    text: res.text,
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
    });
    // /////////////////////////////////

    function fillTelephoneInput(val) {
        store = val.value;
        $('#telephoneInput').val("+" + store);
    }

    


    function myFunction() {
        var dots = document.getElementById("dots");
        var moreText = document.getElementById("more");
        var btnText = $(".myBtn");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.html("Read more");
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.html("Read less");
            moreText.style.display = "inline";
        }
    }
</script>
