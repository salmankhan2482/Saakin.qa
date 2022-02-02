

<?php $__env->startSection('content'); ?>

    <div id="main">
        <div class="page-header">
            <h2> 
                Add Sub City
            </h2>
            <a href="<?php echo e(route('propertySubCities.index')); ?>" class="btn btn-default-light btn-xs">
                <i class="md md-backspace"></i> 
                <?php echo e(trans('words.back')); ?>

            </a>
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
        <?php if(Session::has('message')): ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php echo e(Session::get('message')); ?>

            </div>
        <?php endif; ?>

        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo Form::open(['route' => ['propertySubCities.store'], 'method' => 'POST', 'class' => 'form-horizontal padding-15', 'name' => 'type_form', 'id' => 'type_form', 'role' => 'form', 'enctype' => 'multipart/form-data']); ?>

                
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">
                        City
                    </label>
                    <div class="col-sm-9">
                        <select name="city" id="city" class="form-control">
                            <option value="">Select City</option>
                            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($city->id); ?>"><?php echo e($city->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="" class="col-sm-3 control-label"><?php echo e(trans('words.name')); ?></label>
                    <div class="col-sm-9">
                        <input type="text" name="name" id="name" value="" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Latitude</label>
                    <div class="col-sm-9">
                        <input type="text" name="latitude" id="latitude" placeholder="25.2773946" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">Longitude</label>
                    <div class="col-sm-9">
                        <input type="text" name="longitude" id="longitude" placeholder="51.4985448" class="form-control">
                    </div>
                </div>
                
                <hr>
                <div class="form-group">
                    <div class="col-md-offset-3 col-sm-9 ">
                        <button type="submit" class="btn btn-primary"><?php echo e(trans('words.submit')); ?></button>
                    </div>
                </div>

                <?php echo Form::close(); ?>

            </div>
        </div>


    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp 7.4\htdocs\saakin\resources\views/admin/pages/address/subCities/create.blade.php ENDPATH**/ ?>