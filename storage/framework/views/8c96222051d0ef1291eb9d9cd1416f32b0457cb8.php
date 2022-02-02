
<?php if($landing_page_content->meta_title !=null): ?>

<?php $__env->startSection('title',$landing_page_content->meta_title . ' | '.' Saakin.com'); ?>
<?php $__env->startSection('description',$landing_page_content->meta_description); ?>
<?php $__env->startSection('keyword',$landing_page_content->meta_keyword); ?>
<?php $__env->startSection('type','property'); ?>
<?php $__env->startSection('url',url()->current()); ?>

<?php else: ?>

<?php $__env->startSection('title','Properties in Qatar | Saakin.com'); ?>
<?php $__env->startSection('description',$page_des); ?>
<?php $__env->startSection('type','property'); ?>
<?php $__env->startSection('url',url()->current()); ?>

<?php endif; ?>
<?php $__env->startSection('content'); ?>

    <style>
        .listing-features li i {
            display: block;
            position: initial;
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

        .social-div{
            display: flex;
            text-align: center;
            align-items: center;
            padding: 10px 0 0;
            vertical-align: top;
            width: auto;
        }

        .social-btns{
            color: #222;
            background: #fff; 
            margin: 0 4px; 
            padding: 8px; 
            border-color: #dab7b7;
            line-height: 1em;
            width: auto;
        }

        .social-btns > i{
            color: #009fff;
        }

        .social-btns:hover {
            color: #222;
        }
        .social-btns:focus{
            color: #222;
        }

    </style>
    <div class="breadcrumb-section bg-xs" style="background-image: url('assets/images/backgrounds/bg-8.jpg')">
        <div class="overlay op-5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <div class="breadcrumb-menu">
                        <h1>Buy And Rent Properties in Qatar</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="filter-wrapper style1">
        <div class="container">
            <div class="row pro_desk">
                
                <div class="col-md-3">
                    <div class="sidebar-left">
                        <div class="widget filter-widget">

                            <div class="widget-title widget-collapse">
                                <h6>Advance Filters</h6>
                                <a id="colhide" class="ml-auto" data-toggle="collapse" href="#filter-property"
                                    role="button" aria-expanded="true" aria-controls="filter-property"> 
                                    <i class="fas fa-chevron-down"></i>
                                </a>
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
                                                    <option value="<?php echo e($propertyPurpose->name); ?>" 
                                                        <?php if($request->property_purpose == $propertyPurpose->name): ?> selected <?php endif; ?>
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
                                                    <option value="<?php echo e($propertyType->id); ?>" 
                                                        <?php if($request->property_type == $propertyType->id): ?> selected <?php endif; ?>>
                                                    
                                                        <?php echo e($propertyType->types); ?>

                                                        (<?php echo e($propertyType->pcount); ?>)
                                                    
                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>

                                        <div class="col-xl-6 col-12 mb-3">
                                            <select name="min_price" class="hero__form-input  form-control custom-select">
                                                <option <?php echo e($request->min_price == '' ? 'selected' : ''); ?> value="">Min
                                                    Price</option>
                                                <option <?php echo e($request->min_price == '5000' ? 'selected' : ''); ?>

                                                    value="5000">
                                                    QAR 5,000</option>
                                                <option <?php echo e($request->min_price == '10000' ? 'selected' : ''); ?>

                                                    value="10000">QAR 10,000</option>
                                                <option <?php echo e($request->min_price == '15000' ? 'selected' : ''); ?>

                                                    value="10000">QAR 15,000</option>
                                                <option <?php echo e($request->min_price == '20000' ? 'selected' : ''); ?>

                                                    value="20000">QAR 20,000</option>
                                                <option <?php echo e($request->min_price == '25000' ? 'selected' : ''); ?>

                                                    value="25000">QAR 25,000</option>
                                                <option <?php echo e($request->min_price == '30000' ? 'selected' : ''); ?>

                                                    value="30000">QAR 30,000</option>
                                                <option <?php echo e($request->min_price == '40000' ? 'selected' : ''); ?>

                                                    value="40000">QAR 40,000</option>
                                                <option <?php echo e($request->min_price == '50000' ? 'selected' : ''); ?>

                                                    value="50000">QAR 50,000</option>
                                                <option <?php echo e($request->min_price == '60000' ? 'selected' : ''); ?>

                                                    value="60000">QAR 60,000</option>
                                                <option <?php echo e($request->min_price == '70000' ? 'selected' : ''); ?>

                                                    value="70000">QAR 70,000</option>
                                                <option <?php echo e($request->min_price == '90000' ? 'selected' : ''); ?>

                                                    value="90000">QAR 90,000</option>
                                                <option <?php echo e($request->min_price == '100000' ? 'selected' : ''); ?>

                                                    value="100000">QAR 100,000</option>
                                                <option <?php echo e($request->min_price == '125000' ? 'selected' : ''); ?>

                                                    value="125000">QAR 1,25,000</option>
                                                <option <?php echo e($request->min_price == '150000' ? 'selected' : ''); ?>

                                                    value="150000">QAR 1,50,000</option>

                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-12 mb-3">
                                            <select name="max_price" class="hero__form-input  form-control custom-select">
                                                <option <?php echo e($request->max_price == '' ? 'selected' : ''); ?> value="">Max
                                                    Price</option>
                                                <option <?php echo e($request->max_price == '5000' ? 'selected' : ''); ?>

                                                    value="5000">QAR 5,000</option>
                                                <option <?php echo e($request->max_price == '10000' ? 'selected' : ''); ?>

                                                    value="10000">QAR 10,000</option>
                                                <option <?php echo e($request->max_price == '15000' ? 'selected' : ''); ?>

                                                    value="15000">QAR 15,000</option>
                                                <option <?php echo e($request->max_price == '20000' ? 'selected' : ''); ?>

                                                    value="20000">QAR 20,000</option>
                                                <option <?php echo e($request->max_price == '25000' ? 'selected' : ''); ?>

                                                    value="25000">QAR 25,000</option>
                                                <option <?php echo e($request->max_price == '30000' ? 'selected' : ''); ?>

                                                    value="30000">QAR 30,000</option>
                                                <option <?php echo e($request->max_price == '40000' ? 'selected' : ''); ?>

                                                    value="40000">QAR 40,000</option>
                                                <option <?php echo e($request->max_price == '50000' ? 'selected' : ''); ?>

                                                    value="50000">QAR 50,000</option>
                                                <option <?php echo e($request->max_price == '60000' ? 'selected' : ''); ?>

                                                    value="60000">QAR 60,000</option>
                                                <option <?php echo e($request->max_price == '70000' ? 'selected' : ''); ?>

                                                    value="70000">QAR 70,000</option>
                                                <option <?php echo e($request->max_price == '90000' ? 'selected' : ''); ?>

                                                    value="90000">QAR 90,000</option>
                                                <option <?php echo e($request->max_price == '100000' ? 'selected' : ''); ?>

                                                    value="100000">QAR 100,000</option>
                                                <option <?php echo e($request->max_price == '125000' ? 'selected' : ''); ?>

                                                    value="125000">QAR 1,25,000</option>
                                                <option <?php echo e($request->max_price == '150000' ? 'selected' : ''); ?>

                                                    value="150000">QAR 1,50,000</option>
                                                <option <?php echo e($request->max_price == '250000' ? 'selected' : ''); ?>

                                                    value="250000">QAR 2,50,000</option>
                                                <option <?php echo e($request->max_price == '450000' ? 'selected' : ''); ?>

                                                    value="450000">QAR 4,50,000</option>
                                                <option <?php echo e($request->max_price == '850000' ? 'selected' : ''); ?>

                                                    value="850000">QAR 8,50,000</option>
                                                <option <?php echo e($request->max_price == '1000000' ? 'selected' : ''); ?>

                                                    value="1000000">QAR 1,00,0000</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-12 mb-3">
                                            <select name="min_area" class="hero__form-input  form-control custom-select">
                                                <option <?php if($request->min_area == ''): ?> selected <?php endif; ?> value="">Min Area</option>
                                                <option <?php if($request->min_area == '500'): ?> selected <?php endif; ?> value="500">500 sqm</option>
                                                <option <?php if($request->min_area == '600'): ?> selected <?php endif; ?> value="600">600 sqm</option>
                                                <option <?php if($request->min_area == '700'): ?> selected <?php endif; ?> value="700">700 sqm</option>
                                                <option <?php if($request->min_area == '800'): ?> selected <?php endif; ?> value="800">800 sqm</option>
                                                <option <?php if($request->min_area == '900'): ?> selected <?php endif; ?> value="900">900 sqm</option>
                                                <option <?php if($request->min_area == '1000'): ?> selected <?php endif; ?> value="1000">1000 sqm</option>
                                                <option <?php if($request->min_area == '1100'): ?> selected <?php endif; ?> value="1100">1100 sqm</option>
                                                <option <?php if($request->min_area == '1200'): ?> selected <?php endif; ?> value="1200">1200 sqm</option>
                                                <option <?php if($request->min_area == '1300'): ?> selected <?php endif; ?> value="1300">1300 sqm</option>
                                                <option <?php if($request->min_area == '1400'): ?> selected <?php endif; ?> value="1400">1400 sqm</option>
                                                <option <?php if($request->min_area == '1500'): ?> selected <?php endif; ?> value="1500">1500 sqm</option>
                                                <option <?php if($request->min_area == '1600'): ?> selected <?php endif; ?> value="1600">1600 sqm</option>
                                                <option <?php if($request->min_area == '1700'): ?> selected <?php endif; ?> value="1700">1700 sqm</option>
                                                <option <?php if($request->min_area == '1800'): ?> selected <?php endif; ?> value="1800">1800 sqm</option>
                                                <option <?php if($request->min_area == '1900'): ?> selected <?php endif; ?> value="1900">1900 sqm</option>
                                                <option <?php if($request->min_area == '2000'): ?> selected <?php endif; ?> value="2000">2000 sqm</option>
                                                <option <?php if($request->min_area == '2500'): ?> selected <?php endif; ?> value="2500">2500 sqm</option>
                                                <option <?php if($request->min_area == '3000'): ?> selected <?php endif; ?> value="3000">3000 sqm</option>
                                                <option <?php if($request->min_area == '4000'): ?> selected <?php endif; ?> value="4000">4000 sqm</option>
                                                <option <?php if($request->min_area == '5000'): ?> selected <?php endif; ?> value="5000">5000 sqm</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-12 mb-3">
                                            <select name="max_area" class="hero__form-input  form-control custom-select">
                                                <option <?php if($request->max_area == ''): ?> selected <?php endif; ?> value="">Max Area</option>
                                                <option <?php if($request->max_area == '500'): ?> selected <?php endif; ?> value="500">500 sqm</option>
                                                <option <?php if($request->max_area == '600'): ?> selected <?php endif; ?> value="600">600 sqm</option>
                                                <option <?php if($request->max_area == '700'): ?> selected <?php endif; ?> value="700">700 sqm</option>
                                                <option <?php if($request->max_area == '800'): ?> selected <?php endif; ?> value="800">800 sqm</option>
                                                <option <?php if($request->max_area == '900'): ?> selected <?php endif; ?> value="900">900 sqm</option>
                                                <option <?php if($request->max_area == '1000'): ?> selected <?php endif; ?> value="1000">1000 sqm</option>
                                                <option <?php if($request->max_area == '1100'): ?> selected <?php endif; ?> value="1100">1100 sqm</option>
                                                <option <?php if($request->max_area == '1200'): ?> selected <?php endif; ?> value="1200">1200 sqm</option>
                                                <option <?php if($request->max_area == '1300'): ?> selected <?php endif; ?> value="1300">1300 sqm</option>
                                                <option <?php if($request->max_area == '1400'): ?> selected <?php endif; ?> value="1400">1400 sqm</option>
                                                <option <?php if($request->max_area == '1500'): ?> selected <?php endif; ?> value="1500">1500 sqm</option>
                                                <option <?php if($request->max_area == '1600'): ?> selected <?php endif; ?> value="1600">1600 sqm</option>
                                                <option <?php if($request->max_area == '1700'): ?> selected <?php endif; ?> value="1700">1700 sqm</option>
                                                <option <?php if($request->max_area == '1800'): ?> selected <?php endif; ?> value="1800">1800 sqm</option>
                                                <option <?php if($request->max_area == '1900'): ?> selected <?php endif; ?> value="1900">1900 sqm</option>
                                                <option <?php if($request->max_area == '2000'): ?> selected <?php endif; ?> value="2000">2000 sqm</option>
                                                <option <?php if($request->max_area == '2500'): ?> selected <?php endif; ?> value="2500">2500 sqm</option>
                                                <option <?php if($request->max_area == '3000'): ?> selected <?php endif; ?> value="3000">3000 sqm</option>
                                                <option <?php if($request->max_area == '4000'): ?> selected <?php endif; ?> value="4000">4000 sqm</option>
                                                <option <?php if($request->max_area == '5000'): ?> selected <?php endif; ?> value="5000">5000 sqm</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6 col-12 mb-3">
                                            <select name="bedrooms" id="bedrooms"
                                                class="hero__form-input  form-control custom-select">
                                                <option value="" selected>Bed</option>
                                                <option <?php if($request->bedrooms == 1): ?> selected <?php endif; ?>>1</option>
                                                <option <?php if($request->bedrooms == 2): ?> selected <?php endif; ?>>2</option>
                                                <option <?php if($request->bedrooms == 3): ?> selected <?php endif; ?>>3</option>
                                                <option <?php if($request->bedrooms == 4): ?> selected <?php endif; ?>>4</option>
                                                <option <?php if($request->bedrooms == 5): ?> selected <?php endif; ?>>5</option>
                                                <option <?php if($request->bedrooms == '6+'): ?> selected <?php endif; ?>>6+</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-6 col-12 mb-3">
                                            <select name="bathrooms" id="bathrooms"
                                                class="hero__form-input  form-control custom-select">
                                                <option value="" selected>Bath</option>
                                                <option <?php if($request->bathrooms == 12): ?> selected <?php endif; ?>>1</option>
                                                <option <?php if($request->bathrooms == 2): ?> selected <?php endif; ?>>2</option>
                                                <option <?php if($request->bathrooms == 3): ?> selected <?php endif; ?>>3</option>
                                                <option <?php if($request->bathrooms == 4): ?> selected <?php endif; ?>>4</option>
                                                <option <?php if($request->bathrooms == 5): ?> selected <?php endif; ?>>5</option>
                                                <option <?php if($request->bathrooms == '6+'): ?> selected <?php endif; ?>>6+</option>
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
                                                <input type="checkbox" name="commercial" value="1" id="commercial"
                                                <?php echo e(request('commercial') == 1 ? 'checked' : ''); ?> >
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
                
                <div class="col-md-9" style="min-height: 100px !important;">
                    <?php if(count($properties) > 0): ?>

                        <div class="property-filter d-sm-flex mt-50">
                            <ul class="property-short list-unstyled d-sm-flex mb-0">
                                <li>
                                    <form action="<?php echo e(url('properties')); ?>" name="frmSortBy" id="frmSortBy"
                                        class="form-inline form-1" method="get">
                                        <input 
                                            type="hidden" name="featured" 
                                            id="featured" value="<?php echo e(request()->get('featured')); ?>"
                                        >
                                        <input 
                                            type="hidden" name="property_type"
                                            value="<?php echo e(request()->property_type); ?>" 
                                        >
                                        <input 
                                            type="hidden" name="property_purpose"
                                            value="<?php echo e(request()->property_purpose); ?>" 
                                        />
                                        <input 
                                            type="hidden" name="city"
                                            value="<?php echo e(request()->city); ?>" 
                                        />
                                        <input 
                                            type="hidden" name="subcity"
                                            value="<?php echo e(request()->subcity); ?>" 
                                        />
                                        <input 
                                            type="hidden" name="town"
                                            value="<?php echo e(request()->town); ?>" 
                                        />
                                        <input 
                                            type="hidden" name="area"
                                            value="<?php echo e(request()->area); ?>" 
                                        />
                                        <input 
                                            type="hidden" name="bedrooms" 
                                            value="<?php echo e(request()->bedrooms); ?>" 
                                        />
                                        <input 
                                            type="hidden" name="bathrooms" 
                                            value="<?php echo e(request()->bathrooms); ?>" 
                                        />
                                        <input 
                                            type="hidden" name="min_price" 
                                            value="<?php echo e(request()->min_price); ?>" 
                                        />
                                        <input 
                                            type="hidden" name="max_price" 
                                            value="<?php echo e(request()->max_price); ?>" 
                                        />
                                        <input 
                                            type="hidden" name="min_area" 
                                            value="<?php echo e(request()->min_area); ?>" 
                                        />
                                        <input 
                                            type="hidden" name="max_area" 
                                            value="<?php echo e(request()->max_area); ?>" 
                                        />
                                        <input 
                                            type="hidden" name="furnishings" 
                                            value="<?php echo e(request()->furnishings); ?>" 
                                        />
                                        <input 
                                            type="hidden" name="keywordextra" 
                                            value="<?php echo e(request()->keywordextra); ?>" 
                                        />
                                        <input 
                                            type="hidden" name="keyword" 
                                            value="<?php echo e(request()->keyword); ?>" 
                                        />
                                        <input 
                                            type="hidden" name="keywordMbl" 
                                            value="<?php echo e(request()->keywordMbl); ?>" 
                                        />
                                        <input 
                                            type="hidden" name="commercial" 
                                            value="<?php echo e(request()->commercial); ?>" 
                                        />

                                        
                                        <div class="form-group d-lg-flex d-block">
                                            <label class="justify-content-start">Short by:</label>
                                            <div class="short-by">
                                                <select name="sort_by" id="sort_by"
                                                    class="hero__form-input form-control custom-select"
                                                    onchange="document.getElementById('frmSortBy').submit();">
                                                    <option value="featured" <?php if($request->sort_by == 'featured'): ?> selected <?php endif; ?>>
                                                        Featured
                                                    </option>
                                                    <option value="newest" <?php if($request->sort_by == 'newest'): ?> selected <?php endif; ?>>
                                                        Newest
                                                    </option>
                                                    <option value="low_price" <?php if($request->sort_by == 'low_price'): ?> selected <?php endif; ?>>
                                                        Price (Low)
                                                    </option>
                                                    <option value="high_price" <?php if($request->sort_by == 'high_price'): ?> selected <?php endif; ?>>
                                                        Price (High)
                                                    </option>
                                                    <option value="beds_least" <?php if($request->sort_by == 'beds_least'): ?> selected <?php endif; ?>>
                                                        Beds (Least)
                                                    </option>
                                                    <option value="beds_most" <?php if($request->sort_by == 'beds_most'): ?> selected <?php endif; ?>>
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

                                <li><a class="property-list-icon active" data-toggle="tab" href="#list-view">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </a></li>
                                <li><a class="property-grid-icon" data-toggle="tab" href="#grid-view">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </a></li>
                            </ul>
                        </div>
                        <div class="item-wrapper pt-20">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade property-grid" id="grid-view">
                                    <div class="row row-10-padding">
                                        <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-6 col-lg-4 col-sm-12">
                                                <?php echo $__env->make('front.pages.include.property_box', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>

                                <div class="tab-pane fade active show property-list" id="list-view">
                            <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
Type: '.$property->propertiesTypes->types.'
Location: '.$property->address.'

Link:'.$propertyUrl;
?>
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
                                                                <li class="feature_or"><span> For Rent </span></li>
                                                            <?php elseif($property->property_purpose == 2): ?>
                                                                <li class="feature_or"><span> For Sale</span></li>
                                                            <?php elseif($property->property_purpose != ''||
                                                                $property->property_purpose != null): ?>
                                                                <li class="feature_or">
                                                                    <span> <?php echo e($property->property_purpose); ?></span>
                                                                </li>
                                                            <?php endif; ?>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12 col-8 pl-0">
                                                    <div class="property-title-box">
                                                        <h4>
                                                            <a href="<?php echo e(url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id)); ?>">
                                                                
                                                                <?php echo e($property->property_name); ?>

                                                            </a>
                                                        </h4>
                                                        <div class="property-location">
                                                            <i class="fa fa-map-marker-alt"></i>
                                                            <p><?php echo e($property->address); ?>, <?php echo e($property->city); ?></p>
                                                        </div>
                                                        <ul class="property-feature">
                                                            <?php if($property->getProperty_type()): ?>
                                                                <li><i class="fas fa-bed"></i>
                                                                    <span><?php echo e($property->bedrooms); ?> Bedrooms</span>
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
                                                            
                                                            <a class="trend-right">
                                                                <div class="trend-open">
                                                                    <p style="color: #222">
                                                                        <span class="per_sale">
                                                                        starts from
                                                                    </span>
                                                                    <?php echo e($property->getPrice()); ?>

                                                                        
                                                                    <?php if($property->property_purpose == 'For Rent' || $property->property_purpose == 'Rent'): ?> 
                                                                        / Month
                                                                    <?php endif; ?>
                                                                    </p>
                                                                </div>
                                                            </a>
                                                            
                                                        </div>
                                                        <div class="social-div">
                                                            <ul class="d-flex">
                                                                <li class="mr-10">
                                                                    <?php if(!empty($property->whatsapp)): ?>
                                                                    <a href="javascript:void(0)" 
                                                                        data-property_id=<?php echo e($property->id); ?>

                                                                        data-button_name='Call'
                                                                        class="btn social-btns btnCall btnCount" 
                                                                        data-telNumber="<?php echo e($property->whatsapp); ?>">
                                                                        <i class="fas fa-phone-alt"></i>
                                                                        Call Now
                                                                    </a>

                                                                    <?php else: ?>
                                                                    <a href="javascript:void(0)" 
                                                                        data-property_id=<?php echo e($property->id); ?>

                                                                        data-button_name='Call'
                                                                        class="btn social-btns btnCall btnCount"
                                                                        data-telNumber="<?php echo e($property->Agency->phone); ?>">
                                                                        <i class="fas fa-phone-alt"></i>
                                                                        Call Now
                                                                    </a>
                                                                    <?php endif; ?>
                                                                </li>
                                                                <li class="mr-10">
                                                                    <?php if(!empty($property->whatsapp)): ?>
                                                                        <a 
                                                                            href="//api.whatsapp.com/send?phone=<?php echo e($property->whatsapp); ?>&text=<?php echo e(urlencode($whatsapText)); ?>"
                                                                            class="btn social-btns btnCount"
                                                                            data-property_id=<?php echo e($property->id); ?>

                                                                            data-button_name='WhatsApp'
                                                                            >
                                                                            <i class="fab fa-whatsapp"></i> 
                                                                            WhatsApp
                                                                        </a>
                                                                    <?php elseif(!empty($property->Agency->whatsapp)): ?>
                                                                        <a 
                                                                            href="//api.whatsapp.com/send?phone=<?php echo e($property->Agency->whatsapp); ?>&text=<?php echo e(urlencode($whatsapText)); ?>" 
                                                                            class="btn social-btns btnCount"
                                                                            data-property_id=<?php echo e($property->id); ?>

                                                                            data-button_name='WhatsApp'
                                                                            >
                                                                            <i class="fab fa-whatsapp"></i> 
                                                                            WhatsApp
                                                                        </a>
                                                                    <?php endif; ?>
                                                                </li>
                                                                <li class="mr-10">
                                                                    <button
                                                                        class="btn social-btns btnCount"
                                                                        type="button"
                                                                        data-toggle="modal"
                                                                        data-target="#exampleModal"
                                                                        id="emailBtn"
                                                                        data-property_id=<?php echo e($property->id); ?>

                                                                        data-button_name='Email'
                                                                        data-image="<?php echo e(asset('upload/properties/' . $property->featured_image)); ?>"
                                                                        data-title="<?php echo e($property->property_name); ?>"
                                                                        data-agent="<?php echo e($property->agent_name ?? $property->Agency->name); ?>"
                                                                        data-broker="<?php echo e($property->Agency->name ?? ''); ?>"
                                                                        data-bedroom="<?php echo e($property->bedrooms ?? ''); ?>"
                                                                        data-bathroom="<?php echo e($property->bathrooms ?? ''); ?>"
                                                                        data-area="<?php echo e($property->getSqm() ?? ''); ?>"
                                                                    >
                                                                        <i class="fas fa-envelope-square"></i>
                                                                        Email Now
                                                                    </button>
                                                                </li>
                                                                
                                                            </ul>
                                                        
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

                    <?php if($properties->onFirstPage()): ?>
                    <div class="filter-wrapper style1">
                        <div class="">
                            <div class="meta-paragraph-container">
                                
                                <?php echo $landing_page_content->page_content; ?>

                                
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row pro_mobile">
                <div class="col-12 bg-white d-flex pb-2 filter-btns">
                    <button class="openbtn btn btn-outline-info" style="width: 50%" onclick="openNav()">
                        <i class="fas fa-sort-amount-down"></i> Filters</button>
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
                                    <select name="property_purpose" id="property_purpose"  
                                        onchange="setPropertyPurpose(value)" 
                                        class="hero__form-input  form-control mb-20"
                                    >
                                        <option value="" selected>Property Purpose</option>
                                        <?php $__currentLoopData = $propertyPurposes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propertyPurpose): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($propertyPurpose->name); ?>" 
                                                <?php if($request->property_purpose == $propertyPurpose->name): ?> selected <?php endif; ?>>
                                                <?php echo e($propertyPurpose->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <select name="property_type" class="hero__form-input  form-control mb-20" onchange="setPropertyType(this)">
                                        <option value="" selected>Property Type</option>
                                        <?php $__currentLoopData = $propertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $propertyType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($propertyType->id); ?>" <?php if($request->property_type == $propertyType->id): ?> selected <?php endif; ?>>
                                                <?php echo e($propertyType->types); ?>


                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6">
                                    <select name="min_price" class="hero__form-input  form-control mb-20">
                                        <option <?php echo e($request->min_price == '' ? 'selected' : ''); ?> value="">Min Price
                                        </option>
                                        <option <?php echo e($request->min_price == '5000' ? 'selected' : ''); ?> value="5000">QAR
                                            5000</option>
                                        <option <?php echo e($request->min_price == '10000' ? 'selected' : ''); ?> value="10000">QAR
                                            10000</option>
                                        <option <?php echo e($request->min_price == '15000' ? 'selected' : ''); ?> value="15000">QAR
                                            15000</option>
                                        <option <?php echo e($request->min_price == '20000' ? 'selected' : ''); ?> value="20000">QAR
                                            20000</option>
                                        <option <?php echo e($request->min_price == '25000' ? 'selected' : ''); ?> value="25000">QAR
                                            25000</option>
                                        <option <?php echo e($request->min_price == '30000' ? 'selected' : ''); ?> value="30000">QAR
                                            30000</option>
                                        <option <?php echo e($request->min_price == '40000' ? 'selected' : ''); ?> value="40000">QAR
                                            40000</option>
                                        <option <?php echo e($request->min_price == '50000' ? 'selected' : ''); ?> value="50000">QAR
                                            50000</option>
                                        <option <?php echo e($request->min_price == '60000' ? 'selected' : ''); ?> value="60000">QAR
                                            60000</option>
                                        <option <?php echo e($request->min_price == '70000' ? 'selected' : ''); ?> value="70000">QAR
                                            70000</option>
                                        <option <?php echo e($request->min_price == '90000' ? 'selected' : ''); ?> value="90000">QAR
                                            90000</option>
                                        <option <?php echo e($request->min_price == '100000' ? 'selected' : ''); ?> value="100000">
                                            QAR 100000</option>
                                        <option <?php echo e($request->min_price == '125000' ? 'selected' : ''); ?> value="125000">
                                            QAR 125000</option>
                                        <option <?php echo e($request->min_price == '150000' ? 'selected' : ''); ?> value="150000">
                                            QAR 150000</option>

                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6">
                                    <select name="max_price" class="hero__form-input  form-control  mb-20">
                                        <option <?php echo e($request->max_price == '' ? 'selected' : ''); ?> value="">Max Price
                                        </option>
                                        <option <?php echo e($request->max_price == '5000' ? 'selected' : ''); ?> value="5000">QAR
                                            5000</option>
                                        <option <?php echo e($request->max_price == '10000' ? 'selected' : ''); ?> value="10000">QAR
                                            10000</option>
                                        <option <?php echo e($request->max_price == '15000' ? 'selected' : ''); ?> value="15000">QAR
                                            15000</option>
                                        <option <?php echo e($request->max_price == '20000' ? 'selected' : ''); ?> value="20000">QAR
                                            20000</option>
                                        <option <?php echo e($request->max_price == '25000' ? 'selected' : ''); ?> value="25000">QAR
                                            25000</option>
                                        <option <?php echo e($request->max_price == '30000' ? 'selected' : ''); ?> value="30000">QAR
                                            30000</option>
                                        <option <?php echo e($request->max_price == '40000' ? 'selected' : ''); ?> value="40000">QAR
                                            40000</option>
                                        <option <?php echo e($request->max_price == '50000' ? 'selected' : ''); ?> value="50000">QAR
                                            50000</option>
                                        <option <?php echo e($request->max_price == '60000' ? 'selected' : ''); ?> value="60000">QAR
                                            60000</option>
                                        <option <?php echo e($request->max_price == '70000' ? 'selected' : ''); ?> value="70000">QAR
                                            70000</option>
                                        <option <?php echo e($request->max_price == '90000' ? 'selected' : ''); ?> value="90000">QAR
                                            90000</option>
                                        <option <?php echo e($request->max_price == '100000' ? 'selected' : ''); ?> value="100000">
                                            QAR 100000</option>
                                        <option <?php echo e($request->max_price == '125000' ? 'selected' : ''); ?> value="125000">
                                            QAR 125000</option>
                                        <option <?php echo e($request->max_price == '150000' ? 'selected' : ''); ?> value="150000">
                                            QAR 150000</option>
                                        <option <?php echo e($request->max_price == '250000' ? 'selected' : ''); ?> value="250000">
                                            QAR 250000</option>
                                        <option <?php echo e($request->max_price == '450000' ? 'selected' : ''); ?> value="450000">
                                            QAR 450000</option>
                                        <option <?php echo e($request->max_price == '850000' ? 'selected' : ''); ?> value="850000">
                                            QAR 850000</option>
                                        <option <?php echo e($request->max_price == '1000000' ? 'selected' : ''); ?> value="1000000">
                                            QAR 1000000</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-6 col-6">
                                    <select name="bedrooms" class="hero__form-input  form-control  mb-20">
                                        <option value="" selected>Bed</option>
                                        <option <?php if($request->bedrooms == 1): ?> selected <?php endif; ?>>1</option>
                                        <option <?php if($request->bedrooms == 2): ?> selected <?php endif; ?>>2</option>
                                        <option <?php if($request->bedrooms == 3): ?> selected <?php endif; ?>>3</option>
                                        <option <?php if($request->bedrooms == 4): ?> selected <?php endif; ?>>4</option>
                                        <option <?php if($request->bedrooms == 5): ?> selected <?php endif; ?>>5</option>
                                        <option <?php if($request->bedrooms == '6+'): ?> selected <?php endif; ?>>6+</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-6 col-6">
                                    <select name="bathrooms" class="hero__form-input  form-control mb-20">
                                        <option value="" selected>Bath</option>
                                        <option <?php if($request->bathrooms == 12): ?> selected <?php endif; ?>>1</option>
                                        <option <?php if($request->bathrooms == 2): ?> selected <?php endif; ?>>2</option>
                                        <option <?php if($request->bathrooms == 3): ?> selected <?php endif; ?>>3</option>
                                        <option <?php if($request->bathrooms == 4): ?> selected <?php endif; ?>>4</option>
                                        <option <?php if($request->bathrooms == 5): ?> selected <?php endif; ?>>5</option>
                                        <option <?php if($request->bathrooms == '6+'): ?> selected <?php endif; ?>>6+</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6">
                                    <select name="min_area" class="hero__form-input  form-control  mb-20">
                                        <option <?php if($request->min_area == ''): ?> selected <?php endif; ?> value="">Min Area</option>
                                        <option <?php if($request->min_area == '500'): ?> selected <?php endif; ?> value="500">500 sqm</option>
                                        <option <?php if($request->min_area == '600'): ?> selected <?php endif; ?> value="600">600 sqm</option>
                                        <option <?php if($request->min_area == '700'): ?> selected <?php endif; ?> value="700">700 sqm</option>
                                        <option <?php if($request->min_area == '800'): ?> selected <?php endif; ?> value="800">800 sqm</option>
                                        <option <?php if($request->min_area == '900'): ?> selected <?php endif; ?> value="900">900 sqm</option>
                                        <option <?php if($request->min_area == '1000'): ?> selected <?php endif; ?> value="1000">1000 sqm</option>
                                        <option <?php if($request->min_area == '1100'): ?> selected <?php endif; ?> value="1100">1100 sqm</option>
                                        <option <?php if($request->min_area == '1200'): ?> selected <?php endif; ?> value="1200">1200 sqm</option>
                                        <option <?php if($request->min_area == '1300'): ?> selected <?php endif; ?> value="1300">1300 sqm</option>
                                        <option <?php if($request->min_area == '1400'): ?> selected <?php endif; ?> value="1400">1400 sqm</option>
                                        <option <?php if($request->min_area == '1500'): ?> selected <?php endif; ?> value="1500">1500 sqm</option>
                                        <option <?php if($request->min_area == '1600'): ?> selected <?php endif; ?> value="1600">1600 sqm</option>
                                        <option <?php if($request->min_area == '1700'): ?> selected <?php endif; ?> value="1700">1700 sqm</option>
                                        <option <?php if($request->min_area == '1800'): ?> selected <?php endif; ?> value="1800">1800 sqm</option>
                                        <option <?php if($request->min_area == '1900'): ?> selected <?php endif; ?> value="1900">1900 sqm</option>
                                        <option <?php if($request->min_area == '2000'): ?> selected <?php endif; ?> value="2000">2000 sqm</option>
                                        <option <?php if($request->min_area == '2500'): ?> selected <?php endif; ?> value="2500">2500 sqm</option>
                                        <option <?php if($request->min_area == '3000'): ?> selected <?php endif; ?> value="3000">3000 sqm</option>
                                        <option <?php if($request->min_area == '4000'): ?> selected <?php endif; ?> value="4000">4000 sqm</option>
                                        <option <?php if($request->min_area == '5000'): ?> selected <?php endif; ?> value="5000">5000 sqm</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6">
                                    <select name="max_area" class="hero__form-input  form-control mb-20">
                                        <option <?php if($request->max_area == ''): ?> selected <?php endif; ?> value="">Max Area</option>
                                        <option <?php if($request->max_area == '500'): ?> selected <?php endif; ?> value="500">500 sqm</option>
                                        <option <?php if($request->max_area == '600'): ?> selected <?php endif; ?> value="600">600 sqm</option>
                                        <option <?php if($request->max_area == '700'): ?> selected <?php endif; ?> value="700">700 sqm</option>
                                        <option <?php if($request->max_area == '800'): ?> selected <?php endif; ?> value="800">800 sqm</option>
                                        <option <?php if($request->max_area == '900'): ?> selected <?php endif; ?> value="900">900 sqm</option>
                                        <option <?php if($request->max_area == '1000'): ?> selected <?php endif; ?> value="1000">1000 sqm</option>
                                        <option <?php if($request->max_area == '1100'): ?> selected <?php endif; ?> value="1100">1100 sqm</option>
                                        <option <?php if($request->max_area == '1200'): ?> selected <?php endif; ?> value="1200">1200 sqm</option>
                                        <option <?php if($request->max_area == '1300'): ?> selected <?php endif; ?> value="1300">1300 sqm</option>
                                        <option <?php if($request->max_area == '1400'): ?> selected <?php endif; ?> value="1400">1400 sqm</option>
                                        <option <?php if($request->max_area == '1500'): ?> selected <?php endif; ?> value="1500">1500 sqm</option>
                                        <option <?php if($request->max_area == '1600'): ?> selected <?php endif; ?> value="1600">1600 sqm</option>
                                        <option <?php if($request->max_area == '1700'): ?> selected <?php endif; ?> value="1700">1700 sqm</option>
                                        <option <?php if($request->max_area == '1800'): ?> selected <?php endif; ?> value="1800">1800 sqm</option>
                                        <option <?php if($request->max_area == '1900'): ?> selected <?php endif; ?> value="1900">1900 sqm</option>
                                        <option <?php if($request->max_area == '2000'): ?> selected <?php endif; ?> value="2000">2000 sqm</option>
                                        <option <?php if($request->max_area == '2500'): ?> selected <?php endif; ?> value="2500">2500 sqm</option>
                                        <option <?php if($request->max_area == '3000'): ?> selected <?php endif; ?> value="3000">3000 sqm</option>
                                        <option <?php if($request->max_area == '4000'): ?> selected <?php endif; ?> value="4000">4000 sqm</option>
                                        <option <?php if($request->max_area == '5000'): ?> selected <?php endif; ?> value="5000">5000 sqm</option>
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
                                        <input type="checkbox" name="commercial" value="1" id="commercial2" 
                                        <?php echo e(request('commercial') == 1 ? 'checked' : ''); ?> >
                                        <label for="commercial2">Show commercial Properties only</label>
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
$agency = \App\Agency::where('id', $property->agency_id)->first();
$propertyUrl = url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id);
$whatsapText =
'Hello, 
I would like to inquire about this property posted on saakin.com                                            Reference: ' . $property->refference_code . '
Price: QR ' . $property->getPrice() . '/month
Type: ' . $property->propertiesTypes->types .'
Location: ' . $property->address . '
Link: ' .$propertyUrl;
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
                                                    <p class="property-card__property-title">
                                                    <?php echo e(\Illuminate\Support\Str::limit($property->property_name, 20)); ?>

                                                    </p>
                                                    <div class="property-card__location">
                                                        <?php echo e($property->propertiesTypes->types); ?>

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
                                                    <a class="btn btn-outline-success call_btn" 
                                                    id="emailBtn"
                                                        data-toggle="modal"
                                                        data-target="#exampleModal"
                                                        data-image="<?php echo e(asset('upload/properties/thumb_' . $property->featured_image)); ?>"
                                                        data-title="<?php echo e($property->property_name); ?>"
                                                        data-agent="<?php echo e($property->agent_name ?? $agency->name); ?>"
                                                        data-broker="<?php echo e($agency->name ?? ''); ?>"
                                                        data-bedroom="<?php echo e($property->bedrooms ?? ''); ?>"
                                                        data-bathroom="<?php echo e($property->bathrooms ?? ''); ?>"
                                                        data-area="<?php echo e($property->getSqm() ?? ''); ?>"
                                                    >
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
    

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">

    $('.btnCount').click(function() {
        let id = $(this).attr('data-property_id');
        let button_name = $(this).attr('data-button_name');
        $.ajax({
            type : 'GET',
            url : '<?php echo e(route("click_count")); ?>',
            data : {
                'id': id,
                'button_name': button_name,
            },
            
            success:function(response){
                console.log(response);
            }


        });
    });
    
    // let click = 0;
    // var elements = document.getElementsByClassName("btnCall");

    // var myFunction = function() {
    //     var attribute = this.getAttribute("data-telNumber");
    //     this.innerText = attribute;

    //     // this.href = "tel:"+attribute;
    //     if(click == 0){
    //         this.href = "#";
    //         click++;
            
    //     }else{
    //         this.href = "tel:"+attribute;
    //         click = 0;

    //     }   
    // };

    // for (var i = 0; i < elements.length; i++) {
    //     elements[i].addEventListener('click', myFunction, false);
    // }

    

    function FormSubmit(coming) {
        var value = coming.value;
        $("#sort_by").val(value);
        document.getElementById('frmSortBy').submit();
    }

    function openNav() {
        document.getElementById("mySidebar").style.width = "80%";
    }

    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";

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
<?php $__env->stopPush(); ?>

<?php echo $__env->make("front.layouts.main", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp 7.4\htdocs\saakin\resources\views/front/pages/properties.blade.php ENDPATH**/ ?>