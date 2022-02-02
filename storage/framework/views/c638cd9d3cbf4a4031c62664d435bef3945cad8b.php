<?php $__env->startSection('content'); ?>
    <div id="main">
        <div class="page-header">

            <div class="pull-right">
                <a href="<?php echo e(URL::to('admin/properties/create')); ?>"
                    class="btn btn-primary"><?php echo e(trans('words.add_property')); ?>

                    <i class="fa fa-plus"></i></a>
            </div>
            <h2><?php echo e(trans('words.properties')); ?></h2>
        </div>
        <?php if(Session::has('flash_message')): ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <?php echo e(Session::get('flash_message')); ?>

            </div>
        <?php endif; ?>
        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="panel panel-shadow">
            <div class="panel-body">
                <div class="col-sm-10">
                    <?php echo Form::open(['url' => 'admin/properties', 'class' => 'form-inline filter', 'id' => 'search', 'role' => 'form', 'method' => 'get']); ?>

                    <span class="bold text-muted"><?php echo e(trans('words.search')); ?></span>
                    <div class="form-group">
                        <input type="text" class="form-control" id="" name="keyword"
                            placeholder="<?php echo e(trans('words.search_placeholder')); ?>">
                    </div>
                    <div class="form-group">
                        <select name="purpose" id="basic" class="selectpicker show-tick form-control"
                            data-live-search="false">
                            <option value=""><?php echo e(trans('words.property_purpose')); ?></option>
                            <option value="<?php echo e(trans('words.purpose_sale')); ?>"><?php echo e(trans('words.for_sale')); ?></option>
                            <option value="<?php echo e(trans('words.purpose_rent')); ?>"><?php echo e(trans('words.for_rent')); ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="status" id="basic" class="selectpicker show-tick form-control"
                            data-live-search="false">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="proeprty-type" name="type" class="selectpicker show-tick form-control"
                            data-live-search="false">
                            <option value=""><?php echo e(trans('words.property_type')); ?></option>
                            <?php if(count($propertyTypes) > 0): ?>
                                <?php $__currentLoopData = $propertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($type->id); ?>"><?php echo e($type->types); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit"
                            class="btn btn-default-dark  pull-right"><?php echo e(trans('words.search')); ?></button>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
                <div class="col-sm-2">
                    <a href="<?php echo e(URL::to('admin/properties/export')); ?>"
                        class="btn btn-info btn-md waves-effect waves-light" data-toggle="tooltip"
                        title="<?php echo e(trans('words.export_property')); ?>"><i class="fa fa-file-excel-o"></i>
                        <?php echo e(trans('words.export_property')); ?></a>
                </div>
            </div>
        </div>

        <div class="panel panel-default panel-shadow" id="testing_div">
            <?php echo $__env->make('admin.pages.include.data_tables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        

    </div>

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make("admin.admin_app", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp 7.4\htdocs\saakin\resources\views/admin/pages/properties.blade.php ENDPATH**/ ?>