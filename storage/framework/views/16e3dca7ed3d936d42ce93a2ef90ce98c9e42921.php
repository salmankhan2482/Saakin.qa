<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/jquery.validationEngine.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/languages/jquery.validationEngine-en.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script src="<?php echo e(asset('assets/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/Jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/jquery-ui.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/jquery.validate.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/jquery.formtowizard.js')); ?>"></script>


<script src="<?php echo e(asset('assets/js/dropzone.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/counting-up.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/appear.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/sticky-sidebar.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/bootstrap-select.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/swiper.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/jquery-mb.ytplayer.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/magnific.popup.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datepicker.js')); ?>"></script>
<?php if(Route::currentRouteName() != 'real-estate-agencies'): ?>
<script src="<?php echo e(asset('assets/js/preloadinator.js')); ?>"></script> 
<?php endif; ?>
<script src="<?php echo e(asset('assets/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>
<script src="//code.tidio.co/exbje56mnkrg3tdoi3kflvts6a6mnac7.js" async></script>
<script type="text/javascript" src="<?php echo e(asset('assets/js/image-uploader.js')); ?>"></script>



<script type="text/javascript">

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
                $("#abcd"+ abc).append($("<img/>", {id: 'img', src: '<?php echo e(URL::asset('site_assets/img/x.png')); ?>', alt: 'delete'}).click(function() {
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
</script>

<?php if(request()->segment('1')=='submit-property' or request()->segment('1')=='update-property'): ?>
    <?php if(isset($property->id) AND isset($property->map_latitude) AND isset($property->map_longitude)): ?>
        <?php
            $map_latitude = $property->map_latitude;
            $map_longitude = $property->map_longitude;
        ?>
    <?php else: ?>
        <?php
            $map_latitude = 25.2841478;
            $map_longitude = 51.4419567;
        ?>    
    <?php endif; ?>
    <script type="text/javascript">
        function initialize() {
            var myLatLng = new google.maps.LatLng('<?php echo e($map_latitude); ?>','<?php echo e($map_longitude); ?>');
            var mapOptions = {
                    zoom: 12,
                    center: myLatLng,
                    styles: [{featureType:"landscape",stylers:[{saturation:-100},{lightness:65},{visibility:"on"}]},{featureType:"poi",stylers:[{saturation:-100},{lightness:51},{visibility:"simplified"}]},{featureType:"road.highway",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"road.arterial",stylers:[{saturation:-100},{lightness:30},{visibility:"on"}]},{featureType:"road.local",stylers:[{saturation:-100},{lightness:40},{visibility:"on"}]},{featureType:"transit",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"administrative.province",stylers:[{visibility:"off"}]},{featureType:"administrative.locality",stylers:[{visibility:"off"}]},{featureType:"administrative.neighborhood",stylers:[{visibility:"on"}]},{featureType:"water",elementType:"labels",stylers:[{visibility:"off"},{lightness:-25},{saturation:-100}]},{featureType:"water",elementType:"geometry",stylers:[{hue:"#ffff00"},{lightness:-25},{saturation:-97}]}],
                    mapTypeControl: false,
                    panControl: false,
                    zoomControlOptions: {
                        style: google.maps.ZoomControlStyle.SMALL,
                        position: google.maps.ControlPosition.LEFT_BOTTOM
                    }
                };
            var map = new google.maps.Map(document.getElementById('p-map'), mapOptions);
            var image = '<?php echo e(URL::asset("site_assets/img/marker-1.png")); ?>';

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                draggable: true,
                icon: image
            });
            if (jQuery('#p-address').length > 0) {
                var input = document.getElementById('p-address');
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.setComponentRestrictions({'country': ['qa']});
                google.maps.event.addListener(autocomplete, 'place_changed', function () {
                    var place = autocomplete.getPlace();
                    jQuery('#p-lat').val(place.geometry.location.lat());
                    jQuery('#p-long').val(place.geometry.location.lng());
                    marker.setPosition(place.geometry.location);
                    map.setCenter(place.geometry.location);
                    map.setZoom(15);
                });
            }
            google.maps.event.addListener(marker, 'dragend', function (event) {
                jQuery('#p-lat').val(event.latLng.lat());
                jQuery('#p-long').val(event.latLng.lng());
            });
        }


        google.maps.event.addDomListener(window, 'load', initialize);

    </script>
<?php endif; ?>

<?php if(Request::is('properties/*') AND isset($property->id) AND isset($property->map_latitude) AND isset($property->map_longitude)): ?>
    <script type="text/javascript">
        function initialize() {
            //alert("3");
                <?php if(isset($property->id) AND isset($property->map_latitude) AND isset($property->map_longitude)): ?>
            var myLatLng = new google.maps.LatLng(<?php echo e($property->map_latitude); ?>, <?php echo e($property->map_longitude); ?>);

                <?php endif; ?>

            var mapOptions = {
                    zoom: 12,
                    center: myLatLng,
                    // This is where you would paste any style found on Snazzy Maps.
                    styles: [{featureType:"landscape",stylers:[{saturation:-100},{lightness:65},{visibility:"on"}]},{featureType:"poi",stylers:[{saturation:-100},{lightness:51},{visibility:"simplified"}]},{featureType:"road.highway",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"road.arterial",stylers:[{saturation:-100},{lightness:30},{visibility:"on"}]},{featureType:"road.local",stylers:[{saturation:-100},{lightness:40},{visibility:"on"}]},{featureType:"transit",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"administrative.province",stylers:[{visibility:"off"}]},{featureType:"administrative.locality",stylers:[{visibility:"off"}]},{featureType:"administrative.neighborhood",stylers:[{visibility:"on"}]},{featureType:"water",elementType:"labels",stylers:[{visibility:"off"},{lightness:-25},{saturation:-100}]},{featureType:"water",elementType:"geometry",stylers:[{hue:"#ffff00"},{lightness:-25},{saturation:-97}]}],

                    // Extra options
                    scrollwheel: false,
                    mapTypeControl: false,
                    panControl: false,
                    zoomControlOptions: {
                        style   : google.maps.ZoomControlStyle.SMALL,
                        position: google.maps.ControlPosition.LEFT_BOTTOM
                    }
                }
            var map = new google.maps.Map(document.getElementById('property-details-map'),mapOptions);
            var image = '<?php echo e(URL::asset("site_assets/img/marker.png")); ?>';
            var beachMarker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: image
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
<?php endif; ?>

<?php echo $__env->yieldPushContent('scripts'); ?>
<?php /**PATH C:\xampp 7.4\htdocs\saakin\resources\views/front/layouts/jsscripts.blade.php ENDPATH**/ ?>