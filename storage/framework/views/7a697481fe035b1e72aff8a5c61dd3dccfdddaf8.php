
<?php if($landing_page_content->meta_title !=null): ?>

<?php $__env->startSection('title',$landing_page_content->meta_title . ' | '.' Saakin.com'); ?>
<?php $__env->startSection('description',$landing_page_content->meta_description); ?>
<?php $__env->startSection('keyword',$landing_page_content->meta_keyword); ?>
<?php $__env->startSection('type','property'); ?>
<?php $__env->startSection('url',url()->current()); ?>

<?php else: ?>

<?php $__env->startSection('title',$landing_page_content->title.'|'.'Saakin.com'); ?>
<?php $__env->startSection('description',$landing_page_content->page_content); ?>
<?php $__env->startSection('type','property'); ?>
<?php $__env->startSection('url',url()->current()); ?>

<?php endif; ?>
<?php $__env->startSection('content'); ?>

    <style>
       .listing-features li i {
            display: block;
            position: initial;
        }

        .moreLess {
            display: none;
        }
        @media (min-width: 800px) {
            .liDeskAreaSpan{
                float: left;
                margin-left: 15px;
            }
        
            .list-group{
                margin-left: -14px !important;
            }

        }

        @media (max-width: 800px){
            .list-group{
                width: 72vw !important;
                margin-top: -20px !important;
                margin-left: 0px !important;
            }

            .mbl-search-li{
                width: 100% !important;
                margin-left: 0px !important;
            }
        }

    </style>
    <div class="breadcrumb-section bg-xs" style="background-image: url('../assets/images/backgrounds/bg-8.jpg')">
        <div class="overlay op-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <div class="breadcrumb-menu">
                        <h1 style="color: white" >
                            Properties for <?php echo e(ucfirst($property_purpose)); ?> in Qatar
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="filter-wrapper style1">
        <div class="container">
            <div class="row pro_desk" style="padding-top: 10px;">
                <div class="col-md-12">
                    <div class="property-filter d-sm-flex mt-10">
                        <div class="row d-flex property-filter d-sm-flex ">

                            <?php $__currentLoopData = $propertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propertyType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-3 <?php echo e($loop->index > 7 ? 'moreLess' : ''); ?>">
                                    <?php if(ucfirst($property_purpose) == 'Sale'): ?>
                                        <a 
    href="<?php echo e(route('property-type-purpose',['buy', Str::slug($propertyType->plural) . '-for-'.$property_purpose])); ?>"
                                        >
                                        <span style="color: #009FFF">
                                        <?php $__currentLoopData = explode('-', $propertyType->plural); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span><?php echo e(ucfirst( $key )); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </span>
                                            (<?php echo e($propertyType->pcount); ?>)
                                        </a>
                                    <?php else: ?>
                                        <a 
    href="<?php echo e(route('property-type-purpose',['rent', Str::slug($propertyType->plural) . '-for-'.$property_purpose])); ?>"
                                        >
                                            <span style="color: #009FFF">
                                                <?php $__currentLoopData = explode('-', $propertyType->plural); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <span><?php echo e(ucfirst( $key )); ?></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </span>
                                            (<?php echo e($propertyType->pcount); ?>)
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($cities->count() > 7): ?>
                            <div class="col-12">
                                <button onclick="showLessOrMore()" id="myBtn" class="btn btn-info btn-sm mt-2" 
                                        style="float:right !important">
                                    Show more
                                </button>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row pro_desk">
                <div class="col-md-3">
                    <div class="sidebar-left" style="padding-top: 0px !important; margin-top: 10px;">
                        <div class="widget filter-widget">

                            <div class="widget-title widget-collapse">
                                <h6>Advance Filters</h6>
                                <a id="colhide" class="ml-auto" data-toggle="collapse" href="#filter-property"
                                    role="button" aria-expanded="true" aria-controls="filter-property"> <i
                                        class="fas fa-chevron-down"></i> </a>
                            </div>

                            <div class="collapse show" id="filter-property" style="">
                                <form action="<?php echo e(url('properties')); ?>" class="hero__form v2 filter" method="get">
                                    <input type="hidden" name="featured" id="featured" value="<?php echo e(request()->featured); ?>">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <select name="property_purpose" id="property_purpose"
                                                class="hero__form-input  form-control custom-select" onchange="setPropertyPurpose(value)">
                                                <option value="" selected>Property Purpose</option>
                                                <?php $__currentLoopData = $propertyPurposes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propertyPurpose): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option 
                                                        value="<?php echo e($propertyPurpose->name); ?>"
                                                        <?php echo e(Str::ucfirst($property_purpose) == $propertyPurpose->name ? 'selected' : ''); ?>

                                                    >
                                                        <?php echo e($propertyPurpose->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <select name="property_type" id="property_type"
                                                class="hero__form-input form-control custom-select" onchange="setPropertyType(this)">
                                                <option value="" selected>All Type</option>
                                                <?php $__currentLoopData = $propertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propertyType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($propertyType->id); ?>">
                                                        <?php echo e($propertyType->plural); ?> (<?php echo e($propertyType->pcount); ?>)
                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="col-xl-6 col-12 mb-3">
                                            <select name="min_price" class="hero__form-input  form-control custom-select">
                                                <option value="">Min
                                                    Price</option>
                                                <option value="5000">
                                                    QAR 5,000</option>
                                                <option value="10000">QAR 10,000</option>
                                                <option value="10000">QAR 15,000</option>
                                                <option value="20000">QAR 20,000</option>
                                                <option value="25000">QAR 25,000</option>
                                                <option value="30000">QAR 30,000</option>
                                                <option value="40000">QAR 40,000</option>
                                                <option value="50000">QAR 50,000</option>
                                                <option value="60000">QAR 60,000</option>
                                                <option value="70000">QAR 70,000</option>
                                                <option value="90000">QAR 90,000</option>
                                                <option value="100000">QAR 100,000</option>
                                                <option value="125000">QAR 1,25,000</option>
                                                <option value="150000">QAR 1,50,000</option>

                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-12 mb-3">
                                            <select name="max_price" class="hero__form-input  form-control custom-select">
                                                <option value="">Max
                                                    Price</option>
                                                <option value="5000">QAR 5,000</option>
                                                <option value="10000">QAR 10,000</option>
                                                <option value="15000">QAR 15,000</option>
                                                <option value="20000">QAR 20,000</option>
                                                <option value="25000">QAR 25,000</option>
                                                <option value="30000">QAR 30,000</option>
                                                <option value="40000">QAR 40,000</option>
                                                <option value="50000">QAR 50,000</option>
                                                <option value="60000">QAR 60,000</option>
                                                <option value="70000">QAR 70,000</option>
                                                <option value="90000">QAR 90,000</option>
                                                <option value="100000">QAR 100,000</option>
                                                <option value="125000">QAR 1,25,000</option>
                                                <option value="150000">QAR 1,50,000</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-12 mb-3">
                                            <select name="min_area" class="hero__form-input  form-control custom-select">
                                                <option value="">Min Area</option>
                                                <option value="500">500 sqm</option>
                                                <option value="600">600 sqm</option>
                                                <option value="700">700 sqm</option>
                                                <option value="800">800 sqm</option>
                                                <option value="900">900 sqm</option>
                                                <option value="1000">1000 sqm</option>
                                                <option value="1100">1100 sqm</option>
                                                <option value="1200">1200 sqm</option>
                                                <option value="1300">1300 sqm</option>
                                                <option value="1400">1400 sqm</option>
                                                <option value="1500">1500 sqm</option>
                                                <option value="1600">1600 sqm</option>
                                                <option value="1700">1700 sqm</option>
                                                <option value="1800">1800 sqm</option>
                                                <option value="1900">1900 sqm</option>
                                                <option value="2000">2000 sqm</option>
                                                <option value="2500">2500 sqm</option>
                                                <option value="3000">3000 sqm</option>
                                                <option value="4000">4000 sqm</option>
                                                <option value="5000">5000 sqm</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-12 mb-3">
                                            <select name="max_area" class="hero__form-input  form-control custom-select">
                                                <option value="">Max Area</option>
                                                <option value="500">500 sqm</option>
                                                <option value="600">600 sqm</option>
                                                <option value="700">700 sqm</option>
                                                <option value="800">800 sqm</option>
                                                <option value="900">900 sqm</option>
                                                <option value="1000">1000 sqm</option>
                                                <option value="1100">1100 sqm</option>
                                                <option value="1200">1200 sqm</option>
                                                <option value="1300">1300 sqm</option>
                                                <option value="1400">1400 sqm</option>
                                                <option value="1500">1500 sqm</option>
                                                <option value="1600">1600 sqm</option>
                                                <option value="1700">1700 sqm</option>
                                                <option value="1800">1800 sqm</option>
                                                <option value="1900">1900 sqm</option>
                                                <option value="2000">2000 sqm</option>
                                                <option value="2500">2500 sqm</option>
                                                <option value="3000">3000 sqm</option>
                                                <option value="4000">4000 sqm</option>
                                                <option value="5000">5000 sqm</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-12 mb-3">
                                            <select name="bedrooms" id="bedrooms"
                                                class="hero__form-input  form-control custom-select">
                                                <option value="" selected>Bed</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6+</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-6 col-12 mb-3">
                                            <select name="bathrooms" id="bathrooms"
                                                class="hero__form-input  form-control custom-select">
                                                <option value="" selected>Bath</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6+</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-12 col-12 mb-3">
                                            <select name="furnishings" class="hero__form-input  form-control custom-select">
                                                <option value="">All furnishings</option>
                                                <option value="109" <?php echo e(Request::get('furnishings') == 109 ? 'selected' : ''); ?>>
                                                    Furnished
                                                </option>
                                                <option value="120" <?php echo e(Request::get('furnishings') == 120 ? 'selected' : ''); ?>>
                                                    Unfurnished
                                                </option>
                                                <option value="101" <?php echo e(Request::get('furnishings') == 101 ? 'selected' : ''); ?>>
                                                    Partly furnished
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="input-search">
                                                <input type="text" class="typeahead" name="keywordextra"  
                                                    placeholder="View of Water, Gym, or Security" autocomplete="off"
                                                    value="<?php echo e(Request::get('keywordextra')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="input-search">
                                                <input type="text" class="typeahead" name="keyword" id="country" 
                                                    placeholder="Search Location" autocomplete="off"
                                                    value="<?php echo e(Request::get('keyword')); ?>">
                                            </div>
                                            <div id="country_list" class="col-md-12 col-12" ></div> 
                                            <div id="extra_keywords" style="display: none;"></div>

                                        </div>
                                        <div class="col-12 position-relative mb-3">
                                            <div class="commercial-checkbox">
                                                <input type="checkbox" name="commercial" value="1" id="commercial">
                                                <label for="commercial">Show commercial properties only</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button typeof="submit" class="btn v8" type="submit">Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="sidebar-left">
                                <div class="sidebar-ad">
                                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2421573832685297"
                                    crossorigin="anonymous"></script>
                               <!-- side bar -->
                               <ins class="adsbygoogle"
                                    style="display:block"
                                    data-ad-client="ca-pub-2421573832685297"
                                    data-ad-slot="6760164139"
                                    data-ad-format="auto"
                                    data-full-width-responsive="true"></ins>
                               <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                               </script>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!--Sidebar ends-->
                </div>



                <div class="col-md-9">
                    <div class="row ">
                        
                        
                        <div class="col-12">
                            <?php if(count($properties) > 0): ?>

                                <div class="property-filter d-sm-flex mt-10">
                                    <ul class="property-short list-unstyled d-sm-flex mb-0">
                                        <li>
                                            
                                            <form 
                                                action="<?php echo e(route('property-purpose', [$buyOrRent, $property_purpose])); ?>" name="frmSortBy" 
                                                id="frmSortBy"
                                                class="form-inline form-1" 
                                                method="get"
                                            >
                                                <input type="hidden" name="buyOrRent" 
                                                        value="<?php echo e(Request::segment(1)); ?>" />
                                                <input type="hidden" name="property_purpose" 
                                                        value="<?php echo e(Str::substr(Request::segment(2), -4)); ?>" />

                                                <div class="form-group d-lg-flex d-block">
                                                    <label class="justify-content-start">Sort by:</label>
                                                    <div class="short-by">
                                                        <select 
                                                            name="sort_by" 
                                                            id="sort_by"
                                                            class="hero__form-input form-control custom-select"
                                                            onchange="document.getElementById('frmSortBy').submit();"
                                                        >
                                                            <option value="featured" <?php echo e(request('sort_by') == 'featured' ? 'selected' : ''); ?>>
                                                                Featured
                                                            </option>
                                                            <option value="newest" <?php echo e(request('sort_by') == 'newest' ? 'selected' : ''); ?>>
                                                                Newest
                                                            </option>
                                                            <option value="low_price" <?php echo e(request('sort_by') == 'low_price' ? 'selected' : ''); ?>>
                                                                Price (Low)
                                                            </option>
                                                            <option value="high_price" <?php echo e(request('sort_by') == 'high_price' ? 'selected' : ''); ?>>
                                                                Price (High)
                                                            </option>
                                                            <option value="beds_least" <?php echo e(request('sort_by') == 'beds_least' ? 'selected' : ''); ?>>
                                                                Beds (Least)
                                                            </option>
                                                            <option value="beds_most" <?php echo e(request('sort_by') == 'beds_most' ? 'selected' : ''); ?>>
                                                                Beds (Most)
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>

                                    <ul class="property-view-list nav item-filter-list list-unstyled d-flex mb-0 waqas"
                                        role="tablist">

                                        <li><a class="property-list-icon" data-toggle="tab" href="#list-view">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </a></li>
                                        <li><a class="property-grid-icon active" data-toggle="tab" href="#grid-view">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </a></li>
                                    </ul>
                                </div>
                                <div class="item-wrapper pt-20">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active property-grid" id="grid-view">
                                            <div class="row row-10-padding">
                                                <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="col-md-6 col-lg-4 col-sm-12">
                                                        <?php echo $__env->make('front.pages.include.property_box', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                            </div>
                                        </div>

                                        <div class="tab-pane fade  property-list" id="list-view">
                                            <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="single-property-box">
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-12 col-4 pr-0">
                                                            <div class="property-item">
                                                                <a class="property-img"
                                                                    href="<?php echo e(url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id)); ?>">
                                                                    <?php if($property->featured_image): ?>
                                                                        <img src="<?php echo e(asset('upload/properties/thumb_' . $property->featured_image)); ?>"
                                                                            alt="<?php echo e($property->property_name); ?>">
                                                                    <?php else: ?>
                                                                        <img src="<?php echo e(asset('assets/images/no-img.png')); ?>"
                                                                            alt="<?php echo e($property->property_name); ?>">
                                                                    <?php endif; ?>
                                                                </a>
                                                                <ul class="feature_text">
                                                                    <?php if($property->featured_property == 1): ?>
                                                                        <li class="feature_cb"><span> Featured </span>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <?php if($property->property_purpose == 1): ?>
                                                                        <li class="feature_or"><span> For Rent </span>
                                                                        </li>
                                                                    <?php elseif($property->property_purpose == 2): ?>
                                                                        <li class="feature_or"><span> For Sale</span>
                                                                        </li>
                                                                    <?php elseif($property->property_purpose != ''||
                                                                        $property->property_purpose != null): ?>
                                                                        <li class="feature_or">
                                                                            <span>
                                                                                <?php echo e($property->property_purpose); ?></span>
                                                                        </li>
                                                                    <?php endif; ?>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12 col-8 pl-0">
                                                            <div class="property-title-box">
                                                                <h4>
                                                                    <a
                                                                        href="<?php echo e(url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id)); ?>"><?php echo e($property->property_name); ?></a>
                                                                </h4>
                                                                <div class="property-location">
                                                                    <i class="fa fa-map-marker-alt"></i>
                                                                    <p>
                                                                        <?php echo e($property->address); ?>, <?php echo e($property->city); ?>

                                                                    </p>
                                                                </div>
                                                                <ul class="property-feature">
                                                                    <?php if($property->getProperty_type()): ?>
                                                                        <li><i class="fas fa-bed"></i>
                                                                            <span><?php echo e($property->bedrooms); ?>

                                                                                Bedrooms</span>
                                                                        </li>
                                                                        <li><i class="fas fa-bath"></i>
                                                                            <span><?php echo e($property->bathrooms); ?> Bath</span>
                                                                        </li>
                                                                    <?php endif; ?>
                                                                    <li><i class="fas fa-chart-area"></i>
                                                                        <span><?php echo e($property->getSqm()); ?></span>
                                                                    </li>

                                                                </ul>
                                                                <div class="trending-bottom">
                                                                    <div class="trend-left float-left">
                                                                        <ul class="product-rating">
                                                                            <li><i class="fas fa-star"></i></li>
                                                                            <li><i class="fas fa-star"></i></li>
                                                                            <li><i class="fas fa-star"></i></li>
                                                                            <li><i class="fas fa-star-half-alt"></i></li>
                                                                            <li><i class="fas fa-star-half-alt"></i></li>
                                                                        </ul>
                                                                    </div>
                                                                    <a class="trend-right float-right">
                                                                        <div class="trend-open">
                                                                            <p><span class="per_sale">starts
                                                                                    from</span><?php echo e($property->getPrice()); ?>

                                                                                <?php if($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent'): ?>
                                                                                    / Month
                                                                                <?php endif; ?>
                                                                            </p>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <!--pagination starts-->

                                        <div class="post-nav nav-res pt-20 pb-60">
                                            <div class="row">
                                                <div class="col-md-12  col-xs-12 ">
                                                    <div class="page-num text-center">
                                                    <?php if($properties->total() > getcong('pagination_limit')): ?>
                                                        <?php echo e($properties->links('front.pages.include.pagination')); ?>

                                                    <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--pagination ends-->
                                    </div>
                                </div>


                            <?php else: ?>
                                <div class="item-wrapper pt-20">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="post-nav nav-res pt-20 pb-60">
                                            <div class="row">
                                                <div class="col-md-8 offset-md-2  col-xs-12 ">
                                                    <div class="page-num text-center">
                                                        <h1>Record Not Found!</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pro_mobile">
                <div class="col-12 bg-white d-flex pb-2 filter-btns" style="padding:10px; overflow-x: auto; white-space: nowrap;">
                    <?php $__currentLoopData = $propertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propertyType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                        <?php if(ucfirst($property_purpose) == 'Sale'): ?>
                            <a class="px-3"
href="<?php echo e(route('property-type-purpose',['buy', Str::slug($propertyType->plural) . '-for-'.$property_purpose])); ?>"
                            >
                            <span style="color: #009FFF">
                                <?php $__currentLoopData = explode('-', $propertyType->plural); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span><?php echo e(ucfirst( $key )); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </span>
                                (<?php echo e($propertyType->pcount); ?>)
                            </a>
                        <?php else: ?>
                            <a class="px-3"
href="<?php echo e(route('property-type-purpose',['rent', Str::slug($propertyType->plural) . '-for-'.$property_purpose])); ?>"
                            >
                            <span style="color: #009FFF">
                                <?php $__currentLoopData = explode('-', $propertyType->plural); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span><?php echo e(ucfirst( $key )); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </span>
                                (<?php echo e($propertyType->pcount); ?>)
                            </a>
                        <?php endif; ?>
                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="row pro_mobile">
                <div class="col-12 bg-white d-flex pb-2 filter-btns">
                    <button class="openbtn btn btn-outline-info" style="width: 50%" onclick="openNav()"><i
                            class="fas fa-sort-amount-down"></i> Filters</button>

                        <select name="sort_by" id="sort_by" class="ml-2 mob_sort" onchange="FormSubmit(this);">
                            <option value="featured" 
                            <?php if( isset(request()->sort_by)): ?>    
                            <?php if(request()->sort_by == 'featured'): ?> selected 
                            <?php endif; ?>
                            <?php endif; ?>
                            >
                                Featured
                            </option>
                            <option value="newest" 
                            <?php if( isset(request()->sort_by)): ?>    
                                <?php if(request()->sort_by == 'newest'): ?> selected 
                                <?php endif; ?>
                                <?php endif; ?>
                            >
                                Newest
                            </option>
                            <option value="low_price" 
                            <?php if( isset(request()->sort_by)): ?>    
                                
                            <?php if(request()->sort_by == 'low_price'): ?> selected 
                            <?php endif; ?>
                            <?php endif; ?>
                            >
                            Price (Low)
                            </option>
                            <option value="high_price" 
                            <?php if( isset(request()->sort_by)): ?>    
                                
                            <?php if(request()->sort_by == 'high_price'): ?> selected 
                            <?php endif; ?>
                            <?php endif; ?>
                            
                            >
                            Price (High)
                            </option>
                            <option value="beds_least" 
                            <?php if( isset(request()->sort_by)): ?>        
                            <?php if(request()->sort_by == 'beds_least'): ?> selected 
                            <?php endif; ?>
                            <?php endif; ?>
                            >
                                Beds(Least)
                            </option>
                            <option value="beds_most" 
                            <?php if( isset(request()->sort_by)): ?>    
                                
                            <?php if(request()->sort_by == 'beds_most'): ?> selected 
                            <?php endif; ?>
                            <?php endif; ?>
                            >
                                Beds (Most)
                            </option>
                        </select>
                </div>
                <div id="mySidebar" class="searchbar">
                    <a href="#" class="pl-20">
                        <h4>Search</h4>
                    </a> <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                    <div class="container">
                        <form action="<?php echo e(url('properties')); ?>" method="get">
                            <input type="hidden" name="featured" id="featured" value="<?php echo e(request()->get('featured')); ?>">
                            <div class="row pt-2">
                                <div class="col-md-12">
                                    <select name="property_purpose" id="property_purpose"  onchange="setPropertyPurpose(value)" class="hero__form-input  form-control mb-20">
                                        <option value="" selected>Property Purpose</option>
                                        <?php $__currentLoopData = $propertyPurposes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propertyPurpose): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option 
                                                value="<?php echo e($propertyPurpose->name); ?>"
                                                <?php echo e(Str::ucfirst($property_purpose) == $propertyPurpose->name ? 'selected' : ''); ?>>
                                                    <?php echo e($propertyPurpose->name); ?>

                                                </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <select name="property_type" class="hero__form-input form-control mb-20" onchange="setPropertyType(this)">
                                        <option value="" selected>Property Type</option>
                                        <?php $__currentLoopData = $propertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propertyType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($propertyType->id); ?>">
                                                <?php echo e($propertyType->plural); ?> (<?php echo e($propertyType->pcount); ?>)

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6">
                                    <select name="min_price" class="hero__form-input  form-control mb-20">
                                        <option value="">Min Price
                                        </option>
                                        <option value="5000">QAR
                                            5000</option>
                                        <option value="10000">QAR
                                            10000</option>
                                        <option value="15000">QAR
                                            15000</option>
                                        <option value="20000">QAR
                                            20000</option>
                                        <option value="25000">QAR
                                            25000</option>
                                        <option value="30000">QAR
                                            30000</option>
                                        <option value="40000">QAR
                                            40000</option>
                                        <option value="50000">QAR
                                            50000</option>
                                        <option value="60000">QAR
                                            60000</option>
                                        <option value="70000">QAR
                                            70000</option>
                                        <option value="90000">QAR
                                            90000</option>
                                        <option value="100000">
                                            QAR 100000</option>
                                        <option value="125000">
                                            QAR 125000</option>
                                        <option value="150000">
                                            QAR 150000</option>

                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6">
                                    <select name="max_price" class="hero__form-input  form-control  mb-20">
                                        <option value="">Max Price
                                        </option>
                                        <option value="5000">QAR
                                            5000</option>
                                        <option value="10000">QAR
                                            10000</option>
                                        <option value="15000">QAR
                                            15000</option>
                                        <option value="20000">QAR
                                            20000</option>
                                        <option value="25000">QAR
                                            25000</option>
                                        <option value="30000">QAR
                                            30000</option>
                                        <option value="40000">QAR
                                            40000</option>
                                        <option value="50000">QAR
                                            50000</option>
                                        <option value="60000">QAR
                                            60000</option>
                                        <option value="70000">QAR
                                            70000</option>
                                        <option value="90000">QAR
                                            90000</option>
                                        <option value="100000">
                                            QAR 100000</option>
                                        <option value="125000">
                                            QAR 125000</option>
                                        <option value="150000">
                                            QAR 150000</option>
                                        <option value="250000">
                                            QAR 250000</option>
                                        <option value="450000">
                                            QAR 450000</option>
                                        <option value="850000">
                                            QAR 850000</option>
                                        <option value="1000000">
                                            QAR 1000000</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-6 col-6">
                                    <select name="bedrooms" class="hero__form-input  form-control  mb-20">
                                        <option value="" selected>Bed</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6+</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-6 col-6">
                                    <select name="bathrooms" class="hero__form-input  form-control mb-20">
                                        <option value="" selected>Bath</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6+</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6">
                                    <select name="min_area" class="hero__form-input  form-control  mb-20">
                                        <option value="">Min Area</option>
                                        <option value="500">500 sqm</option>
                                        <option value="600">600 sqm</option>
                                        <option value="700">700 sqm</option>
                                        <option value="800">800 sqm</option>
                                        <option value="900">900 sqm</option>
                                        <option value="1000">1000 sqm</option>
                                        <option value="1100">1100 sqm</option>
                                        <option value="1200">1200 sqm</option>
                                        <option value="1300">1300 sqm</option>
                                        <option value="1400">1400 sqm</option>
                                        <option value="1500">1500 sqm</option>
                                        <option value="1600">1600 sqm</option>
                                        <option value="1700">1700 sqm</option>
                                        <option value="1800">1800 sqm</option>
                                        <option value="1900">1900 sqm</option>
                                        <option value="2000">2000 sqm</option>
                                        <option value="2500">2500 sqm</option>
                                        <option value="3000">3000 sqm</option>
                                        <option value="4000">4000 sqm</option>
                                        <option value="5000">5000 sqm</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6">
                                    <select name="max_area" class="hero__form-input  form-control mb-20">
                                        <option value="">Max Area</option>
                                        <option value="500">500 sqm</option>
                                        <option value="600">600 sqm</option>
                                        <option value="700">700 sqm</option>
                                        <option value="800">800 sqm</option>
                                        <option value="900">900 sqm</option>
                                        <option value="1000">1000 sqm</option>
                                        <option value="1100">1100 sqm</option>
                                        <option value="1200">1200 sqm</option>
                                        <option value="1300">1300 sqm</option>
                                        <option value="1400">1400 sqm</option>
                                        <option value="1500">1500 sqm</option>
                                        <option value="1600">1600 sqm</option>
                                        <option value="1700">1700 sqm</option>
                                        <option value="1800">1800 sqm</option>
                                        <option value="1900">1900 sqm</option>
                                        <option value="2000">2000 sqm</option>
                                        <option value="2500">2500 sqm</option>
                                        <option value="3000">3000 sqm</option>
                                        <option value="4000">4000 sqm</option>
                                        <option value="5000">5000 sqm</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-12 col-12">
                                    <select name="furnishings" class="hero__form-input  form-control mb-20">
                                        <option value="">All furnishings</option>
                                        <option value="109" <?php echo e(Request::get('furnishings') == 109 ? 'selected' : ''); ?>>
                                            Furnished
                                        </option>
                                        <option value="120" <?php echo e(Request::get('furnishings') == 120 ? 'selected' : ''); ?>>
                                            Unfurnished
                                        </option>
                                        <option value="101" <?php echo e(Request::get('furnishings') == 101 ? 'selected' : ''); ?>>
                                            Partly furnished
                                        </option>
                                    </select>
                                </div>
                                
                                <div class="col-md-12 mb-20">
                                    <div class="input-search">
                                        <input type="text" class="" name="keywordextra" id="keywordextra"
                                        placeholder="View of Water, Gym, or Security"
                                        value="<?php echo e(Request::get('keyword') ?? Request::get('keywordextra')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-20">
                                    <div class="input-search">
                                        <input type="text" class="typeahead countryMbl" name="keywordMbl" id="keywordMbl"
                                        placeholder="Search Location"
                                        value="<?php echo e(Request::get('keywordMbl')); ?>">
                                    </div>
                                </div>
                                <div id="country_list_mbl" class="col-md-12 col-12" ></div>
                                <div class="extra_keywords" style="display: none;"></div>
                                
                                <div class="col-12 mb-20 position-relative">
                                    <div class="commercial-checkbox">
                                        <input type="checkbox" name="commercial" value="1" id="commercial2">
                                        <label for="commercial2">Show commercial properties only</label>
                                    </div>
                                </div>
                                <div class="offset-3 col-md-6 col-6"><button type="submit"
                                        class="btn btn-block v3">Search</button></div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12">

                    <div class="card-list featured_mobile">
                        <div class="card-list__item mt-2">
                            <div class="property-card__section">
                                <?php if(count($properties) > 0): ?>
                                    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="property-card">
                                            <div class="property-card__image">
                                                <div class="swiper-container">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <img
                                                                src="<?php echo e(asset('upload/properties/thumb_' . $property->featured_image)); ?>"
                                                                alt="<?php echo e($property->property_name); ?>">
                                                        </div>
                                                        <?php if(count($property->gallery) > 0): ?>
                                                            <?php $__currentLoopData = $property->gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($loop->index < 5): ?>
                                                            <div class="swiper-slide">
                                                                <img src="<?php echo e(asset('upload/gallery/') . '/' . $gallery->image_name); ?>" 
                                                                alt="<?php echo e($property->property_name); ?>">
                                                            </div>
                                                            <?php endif; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </div>
                                                    <!-- Add Pagination -->
                                                    <div class="swiper-pagination"></div>
                                                </div>
                                            </div>

<?php
$phone = \App\Properties::getPhoneNumber($property->id);
$whatsapp = \App\Properties::getWhatsapp($property->id);
$agency = \App\Agency::where("id",$property->agency_id)->first();
$propertyUrl = url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id);
$whatsapText = 'Hello,
I would like to inquire about this property posted on
saakin.com

Reference: '.$property->refference_code.'
Price: QR '.$property->getPrice().'/month
Type: '.$property->propertiesTypes->plural.'
Location: '.$property->address.'

Link:'.$propertyUrl;
?>
                                            <div class="property-card__content">
                                                <div class="property-card__info-area">
                                                    <div class="property-card__title ">
                                                        <a class="property-card__title-link"
                                                            href="<?php echo e(url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id)); ?>">
                                                            <?php echo e($property->getPrice()); ?>

                                                            <?php if($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent'): ?>
                                                                / Month
                                                            <?php endif; ?>
                                                        </a>

                                                    </div>
                                                    <h2 class="property-card__property-title">
                                                        <?php echo e(\Illuminate\Support\Str::limit($property->property_name, 20)); ?>

                                                    </h2>
                                                    <div class="property-card__location">
                                                        <?php echo e($property->propertiesTypes->plural); ?>

                                                        <br>
                                                        <?php echo e(\Illuminate\Support\Str::limit($property->address, 30)); ?>

                                                    </div>
                                                    <div class="property-card__info ">
                                                        <?php if($property->getProperty_type()): ?>
                                                            <i class="fas fa-bed"></i>
                                                            <span><?php echo e($property->bedrooms); ?>

                                                            </span>
                                                            <i class="fas fa-bath"></i>
                                                            <span><?php echo e($property->bathrooms); ?> </span>
                                                        <?php endif; ?>
                                                        <i class="fas fa-chart-area"></i>
                                                        <span><?php echo e($property->getSqm()); ?></span>
                                                    </div>
                                                </div>
                                                <div class="property-card__actions mt-0">
                                                    <?php if($phone != '#'): ?>
                                                        <a class="btn btn-outline-success call_btn"
                                                            href="tel:<?php echo e($phone); ?>">
                                                            <i class="fas fa-phone-alt"></i> Call
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if($whatsapp != '#' && $whatsapp != ''): ?>
                                                        <a href="//api.whatsapp.com/send?phone=<?php echo e($whatsapp); ?>&text=<?php echo e(urlencode(trim($whatsapText))); ?>"
                                                            class="btn btn-success call_btn">
                                                            <i class="fab fa-whatsapp"></i>
                                                            WhatsApp
                                                        </a>
                                                    <?php else: ?>
                                                        <a class="btn btn-outline-success call_btn" id="emailBtn"
                                                            href="mailto:<?php echo e($agency->email); ?>" data-toggle="modal"
                                                            data-target="#exampleModal"
                                                            data-image="<?php echo e(asset('upload/properties/thumb_' . $property->featured_image)); ?>"
                                                            data-title="<?php echo e($property->property_name); ?>"
                                                            data-agent="<?php echo e($property->agent_name ?? $agency->name); ?>"
                                                            data-broker="<?php echo e($agency->name ?? ''); ?>"
                                                            data-bedroom="<?php echo e($property->bedrooms ?? ''); ?>"
                                                            data-bathroom="<?php echo e($property->bathrooms ?? ''); ?>"
                                                            data-area="<?php echo e($property->getSqm() ?? ''); ?>">
                                                            <i class="fas fa-envelope"></i> Email
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            <div class="post-nav nav-res pt-20 pb-60">
                                <div class="row">
                                    <div class="col-md-8 offset-md-2  col-xs-12 ">
                                        <div class="page-num text-center">
                                            <?php if($properties->total() > getcong('pagination_limit')): ?>
                                            <?php echo e($properties->links('front.pages.include.pagination')); ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <?php if($properties->onFirstPage()): ?>
    <div class="filter-wrapper style1">
        <div class="container">
            <div class="meta-paragraph-container">
                
                <?php echo $landing_page_content->page_content; ?>

                
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php echo $__env->make('front.pages.include.emailModal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts-custom'); ?>
<script>
    function showLessOrMore() {
        var btnText = document.getElementById("myBtn");
        var elems = document.getElementsByClassName('moreLess');


        if(btnText.innerHTML == 'Show Less'){
            btnText.innerHTML = "Show More"
            for (var i=0;i<elems.length;i+=1){
                elems[i].style.display = 'none';
            }
        }else{
            btnText.innerHTML = "Show Less"
            for (var i=0;i<elems.length;i+=1){
                elems[i].style.display = 'inline';
            }
        }
    }

    function openNav() {
        document.getElementById("mySidebar").style.width = "80%";
    }

    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";

    }
    function FormSubmit(coming) {
        var value = coming.value;
        $("#sort_by").val(value);
        document.getElementById('frmSortBy').submit();
    }

        //DOTS SLIDER
    var newswiper = new Swiper('.related-homes-slider', {
        slidesPerView: 3,
        spaceBetween: 26,

        dots: true,
        slidesPerColumn: 2,
        grid: {
            rows: 2,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            767: {
                slidesPerView: 1,

            },
            991: {
                slidesPerView: 2,
                spaceBetween: 20,
            }
        }
    });
    
    //DOTS SLIDER
    $(document).ready(function() {
        var width = $(window).width();
        console.log(width)
        if (width < 768) {
            var swiper = new Swiper('.swiper-container', {
                loop: true,
                dots: true,

                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                    dynamicMainBullets: 1,
                },
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("front.layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp 7.4\htdocs\saakin\resources\views/front/pages/properties/properties-for-purpose.blade.php ENDPATH**/ ?>