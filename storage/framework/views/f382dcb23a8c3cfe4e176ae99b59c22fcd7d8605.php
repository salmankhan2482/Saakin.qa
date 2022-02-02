
<div 
    class="single-property-box" 
    style="cursor: pointer;"
    onclick="window.location='<?php echo e(route('property-detail', [strtolower($property->property_purpose), $property->property_slug, $property->id])); ?>';"
    >

    <div class="property-item">
        <?php if($property->featured_image): ?>
            <img 
                src="<?php echo e(URL::asset('upload/properties/thumb_' . $property->featured_image)); ?>" 
                alt="Featured Image of Property">
        <?php else: ?>
            <img 
                src="<?php echo e(URL::asset('assets/images/icon-no-image.svg')); ?>" 
                alt="Image of Property if no Featured Image found">
        <?php endif; ?>

        <ul class="feature_text">
            <?php if($property->featured_property == 1): ?>
                <li class="feature_cb">
                    <span>
                        Featured
                    </span>
                </li>
            <?php endif; ?>
            <li class="feature_or">
                <span>
                    For <?php echo e($property->property_purpose); ?>

                </span>
            </li>
        </ul>

        <div class="property-author-wrap">
            <div class="property-author">
                <span> <?php echo e($property->getPrice()); ?> 
                    <?php if($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent'): ?>
                        / Month
                    <?php endif; ?>
                </span>
            </div>
        </div>

    </div>
    <div 
        class="property-title-box" 
        style="padding-bottom: 35px !important;">

        <h2 class="property-card__property-title">
            <?php echo e(\Illuminate\Support\Str::limit($property->property_name, 20)); ?>

        </h2>

        <div class="property-location">
            <p> <?php echo e(Str::limit($property->propertiesTypes->types, 36)); ?></p>
        </div>

        <div class="property-location">
            <i class="fa fa-map-marker-alt"></i>
            <p> <?php echo e(Str::limit($property->address, 36)); ?></p>
        </div>
        <ul class="property-feature">
            <?php if($property->getProperty_type()): ?>
                <li class="liDesk">
                    <i class="fas fa-bed"></i>
                    <span>
                        <?php echo e($property->bedrooms); ?>

                    </span>
                </li>
                <li class="liDesk">
                    <i class="fas fa-bath"></i>
                    <span>
                        <?php echo e($property->bathrooms); ?>

                    </span>
                </li>
            <?php endif; ?>
            
            <li class="liDeskArea">
                <span class="liDeskAreaSpan">
                    <i class="fas fa-chart-area"></i>
                    <span>
                        <?php echo e($property->getSqm()); ?>

                    </span>
                </span>
            </li>
        </ul>
    </div>
</div>
<?php /**PATH C:\xampp 7.4\htdocs\saakin\resources\views/front/pages/include/property_box.blade.php ENDPATH**/ ?>