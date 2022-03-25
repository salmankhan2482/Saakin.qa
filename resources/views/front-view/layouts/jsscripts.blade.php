<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
</script>
{{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
{{-- <script src="{{ asset('assets/js/jquery.validate.js') }}" defer></script> --}}
{{-- <script src="{{asset('assets/js/bootstrap-select.min.js')}}"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script> --}}
<script src="{{ asset('assets/js/sticky-sidebar.js') }}"></script>


{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js">
</script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-en.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/Jquery.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-ui.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script src="{{asset('assets/js/jquery.formtowizard.js')}}"></script> --}}


{{-- <script src="{{asset('assets/js/dropzone.js')}}"></script>
<script src="{{asset('assets/js/counting-up.js')}}"></script>
<script src="{{asset('assets/js/appear.js')}}"></script>
<script src="{{asset('assets/js/sticky-sidebar.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/js/swiper.js')}}"></script>
<script src="{{asset('assets/js/jquery-mb.ytplayer.js')}}"></script>
<script src="{{asset('assets/js/magnific.popup.js')}}"></script>
<script src="{{asset('assets/js/datepicker.js')}}"></script> --}}


{{-- <script src="{{asset('assets/js/wow.min.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="//code.tidio.co/exbje56mnkrg3tdoi3kflvts6a6mnac7.js" async></script>
<script type="text/javascript" src="{{asset('assets/js/image-uploader.js')}}"></script> --}}

{{-- <script type="text/javascript">
    $(document).ready(function() {
        var width = $(window).width();
        var height = $(window).height();
       
        setTimeout(function () {
            if (width < 991  && height < 991) {
                $('#colhide').trigger('click');
                $(".property-grid-icon,.property-grid").removeClass('active')
                $(".property-grid-icon,.property-grid").removeClass('show')
                $(".property-list-icon,.property-list ").addClass('active')
                $(".property-list-icon,.property-list ").addClass('show')
            }
        },1000)
    });

    function initMap() {
        // The location of Uluru
        var uluru = {lat:25.34429, lng:50.6573094};
        // The map, centered at Uluru
        
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 4, center: uluru});
        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: uluru, map: map});
            //alert("1");
        
    }

    var abc = 0;
    
    $(document).ready(function() {
        $('#add_more').click(function() {//When Add More Files button Clicked these function Willbe Called (new file field is added dynamically)
            $(this).before($("<div/>", {id: 'filediv'}).fadeIn('slow').append(
                $("<input/>", {name: 'gallery_file[]', type: 'file', id: 'file'}),
                $("")
            ));
        });

        $('body').on('change', '#file', function(){
            if (this.files && this.files[0]) {
                //increment();
                abc += 1;
                var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
                $(this).before("<div id='abcd"+ abc +"' class='abcd'><img alt='preview img' id='previewimg" + abc + "' src=''/></div>");
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
                $(this).hide();
                $("#abcd"+ abc).append($("<img/>", {id: 'img', src: '{{ URL::asset('site_assets/img/x.png') }}', alt: 'delete'}).click(function() {
                    //$(this).parent().parent().remove();
                    $(this).parent().remove();
                }));
            }
        });

        function imageIsLoaded(e) {
            $('#previewimg' + abc).attr('src', e.target.result);
        };

        $('#upload').click(function(e) {
            var name = $(":file").val();
            if (!name)
            {
                alert("First Image Must Be Selected");
                e.preventDefault();
            }
        });
    });


    $(document).on('change', '.custom-file-input', function() {
        var files = [];
        var input = $(this)[0];
        var placeToInsertImagePreview = $(this).closest('.custom-file').next('.custom-file-gallery');
        

        if (input.files) {
            var filesAmount = input.files.length;
            placeToInsertImagePreview.html('');
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                var name = input.files[i].name;
                reader.onload = function(event) {
                    $($.parseHTML('<div class="col-6"><img alt="jss scripts" class="img-fluid img-thumb" title="'+name+'" src="'+event.target.result+'"></div>')).appendTo(placeToInsertImagePreview);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }

    });
</script> --}}

@if (Route::currentRouteName() != 'real-estate-agencies')
  <script src="{{ asset('assets/js/preloadinator.js') }}"></script>
@endif

@if (request()->segment('1') == 'submit-property' or request()->segment('1') == 'update-property')
  @if (isset($property->id) and isset($property->map_latitude) and isset($property->map_longitude))
    @php
      $map_latitude = $property->map_latitude;
      $map_longitude = $property->map_longitude;
    @endphp
  @else
    @php
      $map_latitude = 25.2841478;
      $map_longitude = 51.4419567;
    @endphp
  @endif

  <script type="text/javascript">
    function initialize() {
      var myLatLng = new google.maps.LatLng('{{ $map_latitude }}', '{{ $map_longitude }}');
      var mapOptions = {
        zoom: 12,
        center: myLatLng,
        styles: [{
          featureType: "landscape",
          stylers: [{
            saturation: -100
          }, {
            lightness: 65
          }, {
            visibility: "on"
          }]
        }, {
          featureType: "poi",
          stylers: [{
            saturation: -100
          }, {
            lightness: 51
          }, {
            visibility: "simplified"
          }]
        }, {
          featureType: "road.highway",
          stylers: [{
            saturation: -100
          }, {
            visibility: "simplified"
          }]
        }, {
          featureType: "road.arterial",
          stylers: [{
            saturation: -100
          }, {
            lightness: 30
          }, {
            visibility: "on"
          }]
        }, {
          featureType: "road.local",
          stylers: [{
            saturation: -100
          }, {
            lightness: 40
          }, {
            visibility: "on"
          }]
        }, {
          featureType: "transit",
          stylers: [{
            saturation: -100
          }, {
            visibility: "simplified"
          }]
        }, {
          featureType: "administrative.province",
          stylers: [{
            visibility: "off"
          }]
        }, {
          featureType: "administrative.locality",
          stylers: [{
            visibility: "off"
          }]
        }, {
          featureType: "administrative.neighborhood",
          stylers: [{
            visibility: "on"
          }]
        }, {
          featureType: "water",
          elementType: "labels",
          stylers: [{
            visibility: "off"
          }, {
            lightness: -25
          }, {
            saturation: -100
          }]
        }, {
          featureType: "water",
          elementType: "geometry",
          stylers: [{
            hue: "#ffff00"
          }, {
            lightness: -25
          }, {
            saturation: -97
          }]
        }],
        mapTypeControl: false,
        panControl: false,
        zoomControlOptions: {
          style: google.maps.ZoomControlStyle.SMALL,
          position: google.maps.ControlPosition.LEFT_BOTTOM
        }
      };
      var map = new google.maps.Map(document.getElementById('p-map'), mapOptions);
      var image = '{{ URL::asset('site_assets/img/marker-1.png') }}';

      var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        draggable: true,
        icon: image
      });
      if (jQuery('#p-address').length > 0) {
        var input = document.getElementById('p-address');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.setComponentRestrictions({
          'country': ['qa']
        });
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
          var place = autocomplete.getPlace();
          jQuery('#p-lat').val(place.geometry.location.lat());
          jQuery('#p-long').val(place.geometry.location.lng());
          marker.setPosition(place.geometry.location);
          map.setCenter(place.geometry.location);
          map.setZoom(15);
        });
      }
      google.maps.event.addListener(marker, 'dragend', function(event) {
        jQuery('#p-lat').val(event.latLng.lat());
        jQuery('#p-long').val(event.latLng.lng());
      });
    }


    google.maps.event.addDomListener(window, 'load', initialize);
  </script>
@endif

@if (Request::is('properties/*') and isset($property->id) and isset($property->map_latitude) and isset($property->map_longitude))
  <script type="text/javascript">
    function initialize() {
      //alert("3");
      @if (isset($property->id) and isset($property->map_latitude) and isset($property->map_longitude))
        var myLatLng = new google.maps.LatLng({{ $property->map_latitude }}, {{ $property->map_longitude }});
      @endif

      var mapOptions = {
        zoom: 12,
        center: myLatLng,
        // This is where you would paste any style found on Snazzy Maps.
        styles: [{
          featureType: "landscape",
          stylers: [{
            saturation: -100
          }, {
            lightness: 65
          }, {
            visibility: "on"
          }]
        }, {
          featureType: "poi",
          stylers: [{
            saturation: -100
          }, {
            lightness: 51
          }, {
            visibility: "simplified"
          }]
        }, {
          featureType: "road.highway",
          stylers: [{
            saturation: -100
          }, {
            visibility: "simplified"
          }]
        }, {
          featureType: "road.arterial",
          stylers: [{
            saturation: -100
          }, {
            lightness: 30
          }, {
            visibility: "on"
          }]
        }, {
          featureType: "road.local",
          stylers: [{
            saturation: -100
          }, {
            lightness: 40
          }, {
            visibility: "on"
          }]
        }, {
          featureType: "transit",
          stylers: [{
            saturation: -100
          }, {
            visibility: "simplified"
          }]
        }, {
          featureType: "administrative.province",
          stylers: [{
            visibility: "off"
          }]
        }, {
          featureType: "administrative.locality",
          stylers: [{
            visibility: "off"
          }]
        }, {
          featureType: "administrative.neighborhood",
          stylers: [{
            visibility: "on"
          }]
        }, {
          featureType: "water",
          elementType: "labels",
          stylers: [{
            visibility: "off"
          }, {
            lightness: -25
          }, {
            saturation: -100
          }]
        }, {
          featureType: "water",
          elementType: "geometry",
          stylers: [{
            hue: "#ffff00"
          }, {
            lightness: -25
          }, {
            saturation: -97
          }]
        }],

        // Extra options
        scrollwheel: false,
        mapTypeControl: false,
        panControl: false,
        zoomControlOptions: {
          style: google.maps.ZoomControlStyle.SMALL,
          position: google.maps.ControlPosition.LEFT_BOTTOM
        }
      }
      var map = new google.maps.Map(document.getElementById('property-details-map'), mapOptions);
      var image = '{{ URL::asset('site_assets/img/marker.png') }}';
      var beachMarker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: image
      });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
  </script>

@endif

<script>
  $(document).ready(function() {
    var purposeValue = $("#property_purpose").val();
    $('#globalPropertyPurposeValue').val(purposeValue);

    // $('select').selectpicker();

  });

  function setPropertyPurpose(pp) {
    $('#property_purpose').val(pp);
    $('.property_purpose').val(pp);
    $('#globalPropertyPurposeValue').val(pp);

    $.ajax({
      url: "select/buyRent/for/search/" + pp,
      success: function(data) {
        $('.ajaxChange').html(data);
      }
    });

  } //changing featured products on click of rent and buy on search page

  function setPropertyType(pp) {
    console.log(pp.value);
    $('#globalPropertyTypeValue').val(pp.value);
  } //changing featured products on click of rent and buy on search page


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

    console.log(purpose);

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

    //when item is clicked call ajax but dont make changes
    $.ajax({
      url: "{{ route('search-desktop') }}",
      type: "GET",
      data: {
        'country': query
      },
      success: function(data) {}
    })

    var value = $(this).text();
    $('#country').val(value);
    $('#country_list').html("");
  });


  //mobile serach 
  $('.countryMbl').on('keyup', function() {
    var query = $(this).val();
    var purpose = $("#globalPropertyPurposeValue").val();
    var type = $("#globalPropertyTypeValue").val();
    console.log(purpose);
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

    //when item is clicked call ajax but dont make changes
    $.ajax({
      url: "{{ route('search-mobile') }}",
      type: "GET",
      data: {
        'country': query
      },
      success: function(data) {}
    })

    var value = $(this).text();
    $('.countryMbl').val(value);
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



@yield('scripts-custom')

@stack('scripts')
