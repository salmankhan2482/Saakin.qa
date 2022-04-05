<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
</script>

<script src="{{ asset('assets/js/sticky-sidebar.js') }}"></script>

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
            $('#city_id').val('');
            $('#sub_city_id').val('');
            $('#town_id').val('');
            $('#area_id').val('');

        } //if else ends
    });


    $(document).on('click', '.live-search-li', function() {
        var query = 'Stop';

        var value = $(this).text();
        $('#country').val(value);
        $('#extra_keywords').html($(this).html());
        $('#country_list').html("");
    });




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
