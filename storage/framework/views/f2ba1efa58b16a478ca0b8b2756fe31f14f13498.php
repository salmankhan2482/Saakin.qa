<?php $__env->startSection("content"); ?>

    <div id="main">
        <div class="page-header">
            <h2><?php echo e(trans('words.add').' '.trans('words.property')); ?></h2>
            <a href="<?php echo e(URL::to('admin/properties')); ?>" class="btn btn-default-light btn-xs"><i
                    class="md md-backspace"></i> <?php echo e(trans('words.back')); ?></a>
        </div>
        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if(Session::has('flash_message')): ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <?php echo e(Session::get('flash_message')); ?>

            </div>
        <?php endif; ?>

        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo Form::open(array('url' => array('admin/properties/create'), 'method'=>'POST','class'=>'form-horizontal padding-15','name'=>'type_form','id'=>'type_form','role'=>'form','enctype' => 'multipart/form-data')); ?>


                <fieldset>
                    <legend>Basic Details</legend>
                    <?php if(Auth::User()->usertype=="Admin"): ?>
                                        <div class="form-group">
                        <div class="col-md-12">
                            <label>Property Agency *</label>
                            <select class="form-control" name="agency_id" required>
                                <option value="">Select an Agency</option>
                                    <?php $__currentLoopData = \App\Agency::orderBy("name","asc")->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($agency->id); ?>"><?php echo e($agency->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Property Title *</label>
                            <input type="text" class="form-control" placeholder="<?php echo e(trans('words.property_name')); ?>"
                                   name="property_name" id="p-title" value="<?php echo e(old('property_name')); ?>" required/>
                        </div>
                        
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Property Details</legend>
                    <div class="form-group">
                    <div class="col-md-4">
                    <input type="hidden" name="age" value="0"/>
                    <input type="hidden" name="build_area" value="0">
                    <input type="hidden" name="rental_period" value="Monthly">
                    <input type="hidden" name="rooms" value="0">
                    <input type="hidden" name="garage" value="0">
                            <label>Property Purpose</label>
                            <select class="form-control" name="property_purpose"  id="property_purpose" required>
                                <option value=""><?php echo e(trans('words.property_purpose')); ?></option>
                                <?php $__currentLoopData = $purposes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purpose): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($purpose->name); ?>"
                                            <?php if(old('property_purpose')==$purpose->id): ?> selected <?php endif; ?>><?php echo e($purpose->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Property Type</label>
                            <select class="form-control" id="property_type" name="property_type" required>
                                <option value=""><?php echo e(trans('words.property_type')); ?></option>
                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($type->id); ?>"
                                            <?php if(old('property_type')==$type->id): ?> selected <?php endif; ?>><?php echo e($type->types); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>                       
                        <div class="col-md-4">
                            <label>Property Size</label>
                            <input type="number" name="land_area" class="form-control" id="p-land"
                                   placeholder="<?php echo e(trans('words.land_area')); ?> sq.ft" value="<?php echo e(old('land_area')); ?>" required>
                        </div>                      
                    </div>

                    <div class="form-group">
                        
                        <div class="col-md-4">
                            <label>Number of Beds</label>
                            <select id="bedrooms" name="bedrooms"
                                    class="listing-input hero__form-input  form-control custom-select">
                                <option value=""><?php echo e(trans('words.bedroom')); ?></option>
                                <option value="1" <?php if(old('bedrooms')=='1'): ?> selected <?php endif; ?>>1</option>
                                <option value="2" <?php if(old('bedrooms')=='2'): ?> selected <?php endif; ?>>2</option>
                                <option value="3" <?php if(old('bedrooms')=='3'): ?> selected <?php endif; ?>>3</option>
                                <option value="4" <?php if(old('bedrooms')=='4'): ?> selected <?php endif; ?>>4</option>
                                <option value="5" <?php if(old('bedrooms')=='5'): ?> selected <?php endif; ?>>5</option>
                                <option value="6" <?php if(old('bedrooms')=='6'): ?> selected <?php endif; ?>>6</option>
                                <option value="7" <?php if(old('bedrooms')=='7'): ?> selected <?php endif; ?>>7</option>
                                <option value="8" <?php if(old('bedrooms')=='8'): ?> selected <?php endif; ?>>8</option>
                                <option value="9" <?php if(old('bedrooms')=='9'): ?> selected <?php endif; ?>>9</option>
                                <option value="10" <?php if(old('bedrooms')=='10'): ?> selected <?php endif; ?>>10</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Number of Baths</label>
                            <select name="bathrooms" id="bathrooms" class="listing-input hero__form-input  form-control custom-select" >
                                <option value=""><?php echo e(trans('words.bathroom')); ?></option>
                                <option value="1" <?php if(old('bathroom')=='1'): ?> selected <?php endif; ?>>1</option>
                                <option value="2" <?php if(old('bathroom')=='2'): ?> selected <?php endif; ?>>2</option>
                                <option value="3" <?php if(old('bathroom')=='3'): ?> selected <?php endif; ?>>3</option>
                                <option value="4" <?php if(old('bathroom')=='4'): ?> selected <?php endif; ?>>4</option>
                                <option value="5" <?php if(old('bathroom')=='5'): ?> selected <?php endif; ?>>5</option>
                                <option value="6" <?php if(old('bathroom')=='6'): ?> selected <?php endif; ?>>6</option>
                                <option value="7" <?php if(old('bathroom')=='7'): ?> selected <?php endif; ?>>7</option>
                                <option value="8" <?php if(old('bathroom')=='8'): ?> selected <?php endif; ?>>8</option>
                                <option value="9" <?php if(old('bathroom')=='9'): ?> selected <?php endif; ?>>9</option>
                                <option value="10" <?php if(old('bathroom')=='10'): ?> selected <?php endif; ?>>10</option>
                            </select>
                        </div>
                        <div class="col-md-4 ">
                            <label>Property Price</label>

                            <input type="number" name="price" class="form-control" id="p-price" min="0"
                                   placeholder="<?php echo e(trans('words.price')); ?>" value="<?php echo e(old('price')); ?>" required>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label>City</label>
                            <select name="city" id="city" class="form-control" onchange="callSubCityTown(this);"> 
                                <option value="">Select City</option>
                                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($city->id); ?>" <?php echo e(old('city') == $city->id ? 'selected' : ''); ?>>
                                        <?php echo e($city->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            
                        </div>
                        <div class="col-md-6">
                            <label>Sub City</label>
                            <select name="subcity" id="subcity" class="form-control" onchange="callTown(this);">
                                <option value="">Select Sub City</option>
                            <?php $__currentLoopData = $subCities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($subCity->id); ?>" <?php echo e(old('subcity') == $subCity->id ? 'selected' : ''); ?>>
                                    <?php echo e($subCity->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label>Town</label>
                            <select name="town" id="town" class="form-control" onchange="callArea(this);">
                                <option value="">Select Town</option>
                            <?php $__currentLoopData = $towns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $town): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($town->id); ?>" <?php echo e(old('town') == $town->id ? 'selected' : ''); ?>>
                                    <?php echo e($town->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Area</label>
                            <select name="area" id="area" class="form-control" onchange="callLatLong(this);">
                                <option value="">Select Area</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <label>Longitude</label>
                            <input type="text" name="map_longitude" placeholder="<?php echo e(trans('words.longitude')); ?>"
                                   id="p-long" class="form-control" value="<?php echo e(old('map_longitude')); ?>" />
                        </div>
                        <div class="col-md-6">
                            <label>Latitude</label>
                            <input type="text" name="map_latitude" placeholder="<?php echo e(trans('words.latitude')); ?>"
                                   id="p-lat" class="form-control" value="<?php echo e(old('map_latitude')); ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                    <div class="col-md-4">
                            <label>Agent Name</label>
                            <input type="text" placeholder="Agent Name" class="form-control" autocomplete="off" value="<?php echo e(old('agent_name')); ?>" name="agent_name" id="agent_name">
                           
                        </div>
                        <div class="col-md-4">
                            <label>Agent Whatsapp</label>
                            <input type="text" placeholder="Whatsapp Number" class="form-control" autocomplete="off" value="<?php echo e(old('whatsapp')); ?>" name="whatsapp" id="whatsapp">
                           
                        </div>
                        <div class="col-md-4">
                            <label>Agent Picture</label>
                            <input type="file" name="agent_picture" id="agent_picture" class="form-control">
                           
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Description</label>
                            <textarea class="form-control" rows="4" name="description" id="p-desc" required
                                      placeholder="<?php echo e(trans('words.description')); ?>"><?php echo e(old('description')); ?></textarea>
                        </div>
                    </div>
                </fieldset>
                <input type="hidden" name="video_code" class="form-control" value="0">
                <fieldset>
                    <legend>Gallery</legend>
              
                    <div class="form-group">
                        <div class="col-md-8">
                            <label>Gallery Image(s)</label>
                            <div class="gallery_image"></div>
                        </div>
                        <div class="col-md-4">
                            <label>Featured Image</label>
                            <input type="file" name="featured_image"  class="form-control" required>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                <div class="form-group">
                <legend>Amenities</legend>
                        <div class="col-md-12">
                           
                            <div class="row">
                                <?php if(count($amenities)>0): ?>
                                    <?php $__currentLoopData = $amenities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $amenity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-4 custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="property_features[]"
                                                          value="<?php echo e($amenity->id); ?>"/><label class="custom-control-label" for="customCheck"><?php echo e($amenity->name); ?></label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                </fieldset>
                

                <fieldset>
                    <legend>Property Documents</legend>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="custom-file">
                                <input type="file" name="property_document" class="custom-file-input" multiple=""
                                       id="property_document" aria-describedby="property_document"
                                       style="color: green;border: 1px dashed #123456;background-color: #f9ffe5;">
                                <label class="custom-file-label" for="property_document">Choose Document ONLY (584px ×
                                    515px)</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label><?php echo e(trans('words.meta_title')); ?></label>
                            <input class="form-control" rows="4" name="meta_title" id="p-desc" value=""
                                      placeholder="<?php echo e(trans('words.meta_title')); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label><?php echo e(trans('words.meta_description')); ?></label>
                            <textarea class="form-control" rows="4" name="meta_description" id="meta_description"
                                      placeholder="<?php echo e(trans('words.meta_description')); ?>"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <label><?php echo e(trans('words.meta_keyword')); ?></label>
                            <textarea class="form-control" rows="4" name="meta_keyword" id="meta_keyword"
                                      placeholder="<?php echo e(trans('words.meta_keyword')); ?>"></textarea>
                        </div>
                    </div>

                    

                    <div class="form-group">
                        <div class="col-md-6">
                            <button id="SaveProperty" type="submit" class="btn btn-primary">Save Property</button>
                        </div>

                        <div class="col-md-6">

                        </div>
                    </div>
                </fieldset>

                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts-custom'); ?>
    <script>

        function callSubCityTown(data) {
            var id = data.value;
            
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('callSubCityTown')); ?>",
                async: true,
                data: {
                    id: id // as you are getting in request('id') 
                },
                success: function (response) {
                    var subcities = response['subcities'];
                    var towns = response['towns'];
                    var areas = response['areas'];
                    
                    clearEveryThing('subcity', 'town', 'area', 'p-lat', 'p-long');
                    
                    if(subcities == '<option value="">No Result Found</option>'){
                        $("#subcity").append('<option value="">No Result Found</option>');
                    }else{
                        $.each(subcities, function(key,value){
                            $("#subcity").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }    


                    if(towns === '<option value="">No Result Found</option>'){     
                        $("#town").append('<option value="">No Result Found</option>');
                    }else{     
                        $.each(towns, function(key,value){
                            $("#town").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }
                    
                    if(areas === '<option value="">No Result Found</option>'){
                        $("#area").append('<option value="">No Result Found</option>');
                    }
                    else{
                        $("#area").empty();     
                        $.each(areas, function(key,value){
                            $("#area").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }
                    
                    assingLatLong(areas[0].latitude, areas[0].longitude, towns[0].latitude, 
                            towns[0].longitude, subcities[0].longitude, subcities[0].longitude);

                }
            });

        }


        function callTown(data) {
            var id = data.value;
            
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('callTown')); ?>",
                async: true,
                data: {
                    id: id // as you are getting in request('id') 
                },
                success: function (response) {
                    var subcities = response['subcities'];
                    var towns = response['towns'];
                    var areas = response['areas'];

                    clearEveryThing('', 'town', 'area', 'p-lat', 'p-long');

                    if(towns == '<option value="">No Result Found</option>'){
                        $("#town").append('<option value="">No Result Found</option>');
                    }
                    else{
                        $.each(towns, function(key,value){
                        $("#town").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }

                    if(areas == '<option value="">No Result Found</option>'){
                        $("#area").append('<option value="">No Result Found</option>');
                    }
                    else{
                        $.each(areas, function(key,value){
                            $("#area").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }

                    assingLatLong(areas[0].latitude, areas[0].longitude, towns[0].latitude, 
                            towns[0].longitude, subcities[0].longitude, subcities[0].longitude);
                }
            });

        }
    
    
        function callArea(data) {
            var id = data.value;
            
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('callArea')); ?>",
                async: true,
                data: {
                    id: id // as you are getting in request('id') 
                },
                success: function (response) {
                    var areas = response['areas'];
                    var subcities = response['subcities'];
                    var towns = response['towns'];

                    clearEveryThing('', '', 'area', 'p-lat', 'p-long');

                    if(areas === '<option value="">No Result Found</option>'){
                        $("#area").append('<option value="">No Result Found</option>');

                    }else{
                        $("#area").empty();     
                        $.each(areas, function(key,value){
                            $("#area").append('<option value="'+value.id+'">'+value.name+'</option>');
                            $("#p-lat").val(value.latitude);
                            $("#p-long").val(value.longitude);
                        });
                    }

                    assingLatLong(areas[0].latitude, areas[0].longitude, towns[0].latitude, 
                            towns[0].longitude, subcities[0].longitude, subcities[0].longitude);

                }
            });

        }

        function callLatLong(data) {
            var id = data.value;
            
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('callLatLong')); ?>",
                async: true,
                data: {
                    id: id // as you are getting in request('id') 
                },
                success: function (response) {
                    
                    var subcities = response['subcities'];
                    var towns = response['towns'];
                    var areas = response['latLong'];
                    
                    $("#p-lat").val('');
                    $("#p-long").val('');
                    
                    assingLatLong(areas.latitude, areas.longitude, towns.latitude, 
                            towns.longitude, subcities.longitude, subcities.longitude);

                }
            });

        }

        function assingLatLong(alat, alon, tlat, tlon, slat, slon){
            if(alat && alon){
                $("#p-lat").val(alat);
                $("#p-long").val(alon);
            }else if(tlat && tlon){
                $("#p-lat").val(tlat);
                $("#p-long").val(tlon);
            }else if(slat && slon){
                $("#p-lat").val(slat);
                $("#p-long").val(slon);
            }
        }

        function clearEveryThing(subcity, town, area, p_lat, p_long ){
            $(`#${subcity}`).empty(); 
            $(`#${town}`).empty();
            $(`#${area}`).empty();    
            $(`#${p_lat}`).val('');
            $(`#${p_long}`).val('');
        }


        $('.gallery_image').imageUploader({
            maxFiles: 10,
            extensions: ['.jpg', '.jpeg', '.png', '.gif'],
            mimes: ['image/jpeg', 'image/png', 'image/gif'],

        });

        $("form[name='type_form']").parsley();
        
        $(document).on('change','#property_purpose',function (){
            var val = $('#property_purpose').val();
            if(val == 'For Rent'){
                $('.rental_period').css('display','block');
            }else{
                $('.rental_period').css('display','none');
            }
        });

        
        $('#property_type').on('change', function(){
            var proprty_type = $(this).val();
            const proprty_type_id = ['4', '7', '13', '15', '16', '17', '23', '27', '34', '35','36'];
            if (proprty_type_id.includes(proprty_type) == true) {

                console.log(proprty_type);
                $('#bathrooms').prop('required',false).removeClass('error').attr("aria-required","false");
                $('#bedrooms').prop('required',false).removeClass('error').attr("aria-required","false");
            } 
            else
            {
                $('#bathrooms').prop('required',true).removeClass('error').attr("aria-required","true");
                $('#bedrooms').prop('required',true).removeClass('error').attr("aria-required","true");
            }
        });  
        CKEDITOR.replace( 'description' );
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp 7.4\htdocs\saakin\resources\views/admin/pages/add_property.blade.php ENDPATH**/ ?>