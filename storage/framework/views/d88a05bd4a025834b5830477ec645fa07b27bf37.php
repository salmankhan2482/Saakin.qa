<div class="panel-body table-responsive" style="min-height: 700px;">
    <table class="table table-striped table-hover dt-responsive" cellspacing="0" width="100%" id="example">
        <thead>
            <tr>
                <th><?php echo e(trans('words.property_id')); ?></th>
                <th><?php echo e(trans('words.user_name')); ?></th>
                <th style=" width: 190px; "><?php echo e(trans('words.property_name')); ?></th>
                <th style=" width: 160px; "><?php echo e(trans('words.type')); ?></th>
                <th><?php echo e(trans('words.purpose')); ?></th>
                <th><?php echo e(trans('words.view')); ?></th>
                <th><?php echo e(trans('words.create_date')); ?></th>
                <th class="text-center"><?php echo e(trans('words.status')); ?></th>
                <th class="text-center width-100"><?php echo e(trans('words.action')); ?></th>
            </tr>
        </thead>

        <tbody>

            <?php if(count($propertieslist) > 0): ?>
                <?php $__currentLoopData = $propertieslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $pUser = \App\User::where('id', $property->user_id)->first();
                    ?>
                    <tr>
                        <td><?php echo e($property->id); ?></td>
                        <?php if($pUser): ?>
                            <td><?php echo e($pUser->name); ?></td>
                        <?php else: ?>
                            <td style="color:#F00 !important; font-weight:bold !important;">User Removed</td>
                        <?php endif; ?>
                        <td>
                            <a
                                href="<?php echo e(url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id)); ?>">
                                <?php echo e($property->property_name); ?>

                            </a>
                        </td>
                        <td>
                            <?php echo e($property->property_type ? getPropertyTypeName($property->property_type)->types : ''); ?>

                        </td>
                        <td>
                            <?php echo e($property->property_purpose); ?>

                        </td>
                        <td>
                            <?php echo e(App\PageVisits::where('property_id', $property->id)->count() ?? 0); ?>

                        </td>
                        <td>
                            <?php if($property->created_at !== null): ?>
                                <?php echo e(date('d-m-Y', strtotime($property->created_at))); ?>

                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($property->status == 1): ?>
                                <span class="icon-circle bg-green">
                                    <i class="md md-check"></i>
                                </span>
                            <?php else: ?>
                                <span class="icon-circle bg-orange">
                                    <i class="md md-close"></i>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                
                                <button type="button" class="btn btn-default-dark dropdown-toggle"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <?php echo e(trans('words.action')); ?> 
                                    <span class="caret"></span>
                                </button>
                                
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <?php if($pUser): ?>
                                        <?php if(Auth::User()->usertype == 'Admin'): ?>
                                            <li>
                                                <a href="Javascript:void(0);" data-toggle="modal"
                                                    data-target="#PropertyPlanModal<?php echo e($property->id); ?>">
                                                    <i class="fa fa-dollar"></i>
                                                    <?php echo e(trans('words.change_plan')); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <li>
                                            <a href="<?php echo e(url('admin/properties/edit/' . $property->id)); ?>">
                                                <i class="md md-edit"></i>
                                                <?php echo e(trans('words.edit')); ?>

                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo e(url('admin/properties/gallery/' . $property->id)); ?>">
                                                <i class="md md-edit"></i>
                                                Gallery Images
                                            </a>
                                        </li>

                                        <?php if(Auth::User()->usertype == 'Admin'): ?>
                                            <li>
                                                <?php if($property->featured_property == 0): ?>
                                                    <a
                                                        href="<?php echo e(url('admin/properties/featuredproperty/' . Crypt::encryptString($property->id))); ?>">
                                                        <i class="md md-star"></i>
                                                        <?php echo e(trans('words.set_as_featured')); ?>

                                                    </a>
                                                <?php else: ?>
                                                    <a
                                                        href="<?php echo e(url('admin/properties/featuredproperty/' . Crypt::encryptString($property->id))); ?>"><i
                                                            class="md md-check"></i>
                                                        <?php echo e(trans('words.unset_as_featured')); ?></a>
                                                <?php endif; ?>
                                            </li>
                                        <?php endif; ?>
                                        
                                        <li>
                                            <?php if($property->status == 1 && Auth::User()->usertype == 'Admin'): ?>
                                                <a
                                                    href="<?php echo e(url('admin/properties/status/' . Crypt::encryptString($property->id))); ?>">
                                                    <i class="md md-close"></i>
                                                    <?php echo e(trans('words.unpublish')); ?>

                                                </a>
                                            <?php elseif($property->status == 0 && Auth::User()->usertype == 'Admin'): ?>
                                                <a
                                                    href="<?php echo e(url('admin/properties/status/' . Crypt::encryptString($property->id))); ?>"><i
                                                        class="md md-check"></i>
                                                    <?php echo e(trans('words.publish')); ?>

                                                </a>
                                            <?php endif; ?>
                                        </li>

                                        <li>
                                            <?php if($property->status == 0 && Auth::User()->usertype != 'Admin'): ?>
                                                <a href="<?php echo e(url('admin/properties/status/' . Crypt::encryptString($property->id))); ?>">
                                                    <i class="md md-check"></i>
                                                    <?php echo e(trans('words.publish')); ?>

                                                </a>
                                            <?php endif; ?>
                                        </li>

                                    <?php else: ?>
                                        <li>
                                        <a href="<?php echo e(url('admin/properties/status/' . Crypt::encryptString($property->id))); ?>">
                                                <i class="md md-close"></i>
                                                <?php echo e(trans('words.unpublish')); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(Auth::User()->usertype == 'Admin'): ?>
                                    <li>
                                        <a href="<?php echo e(url('admin/properties/delete/' . Crypt::encryptString($property->id))); ?>"
                                                onclick="return confirm('<?php echo e(trans('words.dlt_warning_text')); ?>')"
                                            >
                                            <i class="md md-delete"></i> 
                                            <?php echo e(trans('words.remove')); ?>

                                        </a>
                                    </li>
                                    <?php elseif(Auth::User()->usertype != 'Admin' && $property->status == 1): ?>
                                    <li>
                                        <a  href="#" 
                                            class="callRemovePropertyPopup" 
                                            data-id="<?php echo e(Crypt::encryptString($property->id)); ?>"
                                            data-toggle="modal" data-target="#removePropertyPopup"
                                        >
                                            <i class="md md-delete"></i> 
                                            <?php echo e(trans('words.remove')); ?>

                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>

                        </td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No Record Found</td>
                </tr>

            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="9" class="text-center">
                    <?php echo $__env->make('admin.pagination', ['paginator' => $propertieslist], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </td>
            </tr>
        </tfoot>
    </table>

      <!-- removePropertyPopup Modal -->
    
      <div class="modal fade" id="removePropertyPopup" tabindex="-1" role="dialog" aria-labelledby="removePropertyPopup" aria-hidden="true">
        
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        
            <div class="modal-header" style="padding: 10px">
            <h5 class="modal-title" id="exampleModalLongTitle">
                Reason to Inactive Property
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -23px">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            
            <form  method="POST" id="removePropertyPopupForm">
                <?php echo csrf_field(); ?>
                
                <div class="modal-body" style="padding: 10px">
                    <label for="reason" >
                        Select Reason
                    </label>
                    
                    <select name="reason" id="reason" class="form-control">
                        <option value="Rented/Sold">Rented/Sold</option>
                        <option value="Unavailable">Unavailable</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                
                </div>
                <div class="modal-footer" style="padding: 10px">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">
                    Save changes
                </button>
                </div>
            </form>
        </div>
        </div>
    </div>


    <script>
        $(".callRemovePropertyPopup").on('click', function(e){
            var id = $(this).attr('data-id');
            $("#removePropertyPopupForm").attr('action', `properties/delete/${id}`);
        });
    </script><?php /**PATH C:\xampp 7.4\htdocs\saakin\resources\views/admin/pages/include/data_tables.blade.php ENDPATH**/ ?>