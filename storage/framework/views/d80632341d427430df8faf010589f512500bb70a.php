<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo e($site_url); ?></loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    
    <url>
        <loc><?php echo e($site_url); ?>/properties</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc><?php echo e($site_url); ?>/featured-properties</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
   
    <url>
        <loc><?php echo e($site_url); ?>/about-us</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc><?php echo e($site_url); ?>/terms-of-use</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    
    <url>
        <loc><?php echo e($site_url); ?>/privacy-policy</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc><?php echo e($site_url); ?>/contact-us</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc><?php echo e($site_url); ?>/blogs</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc><?php echo e($site_url); ?>/real-estate-agencies</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc><?php echo e($site_url); ?>/city-guide</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>



    <url>
        <loc><?php echo e($site_url); ?>/buy/properties-for-sale</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>



    
    <url>
        <loc><?php echo e($site_url); ?>/rent/properties-for-rent</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    


    
    <?php $__currentLoopData = $salePropertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p => $propertyType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(route('property-type-purpose',['buy', Str::slug($propertyType->plural) . '-for-sale'])); ?></loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
     </url>  
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    

    

    
    <?php $__currentLoopData = $rentPropertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p => $propertyType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(route('property-type-purpose',['rent', Str::slug($propertyType->plural) . '-for-rent'])); ?></loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
     </url>  
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    


    
    <?php $__currentLoopData = $rentPropertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
            $cities = DB::table('property_cities')
            ->leftJoin('properties', 'property_cities.id', 'properties.city')
            ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_purpose', 'Rent')
            ->where('property_type', $type->id)
            ->groupBy('property_cities.name')
            ->orderBy("pcount", "DESC")
            ->get();
            
            ?>
            <?php if(!$cities->isEmpty()): ?>
                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <url>
                    <loc>
                        <?php echo e(route('cpt-purpose', ['rent', Str::slug($item->slug), Str::slug($type->plural) . '-for-rent' ])); ?>

                    </loc>
                    <changefreq>Daily</changefreq>
                    <priority>1</priority>
                </url>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                
            <?php endif; ?>
            
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    

    
    <?php $__currentLoopData = $salePropertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
            $cities = DB::table('property_cities')
            ->leftJoin('properties', 'property_cities.id', 'properties.city')
            ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_purpose', 'Sale')
            ->where('property_type', $type->id)
            ->groupBy('property_cities.name')
            ->orderBy("pcount", "DESC")
            ->get();
            
            ?>
            <?php if(!$cities->isEmpty()): ?>
                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <url>
                    <loc>
                        <?php echo e(route('cpt-purpose', ['buy', Str::slug($item->slug), Str::slug($type->plural) . '-for-sale' ])); ?>

                    </loc>
                    <changefreq>Dailyaa</changefreq>
                    <priority>1</priority>
                </url>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                
            <?php endif; ?>
            
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    
    <?php $__currentLoopData = $rentPropertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
            $cities = DB::table('property_cities')
            ->leftJoin('properties', 'property_cities.id', 'properties.city')
            ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_purpose', 'Rent')
            ->where('property_type', $type->id)
            ->groupBy('property_cities.name')
            ->orderBy("pcount", "DESC")
            ->get();
            
            ?>
            <?php if(!$cities->isEmpty()): ?>
                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php
                $subcities = DB::table('property_sub_cities')
                    ->leftJoin('properties', 'property_sub_cities.id', 'properties.subcity')
                    ->select('property_sub_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
                    ->where('property_sub_cities.property_cities_id', $city->id)
                    ->where("properties.status", 1)
                    ->where('property_purpose', 'Rent')
                    ->where('properties.property_type', $type->id)
                    ->groupBy("property_sub_cities.id")
                    ->orderBy("pcount", "desc")
                    ->get();
                ?>
                    <?php $__currentLoopData = $subcities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <url>
                            <loc>
                                <?php echo e(route('cpt-purpose', ['rent', Str::slug($city->slug), Str::slug($type->plural) . '-for-rent-'.$item->slug ])); ?>

                            </loc>
                            <changefreq>Daily</changefreq>
                            <priority>1</priority>
                        </url>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                    
                
            <?php endif; ?>
            
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    


    
    <?php $__currentLoopData = $salePropertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
            $cities = DB::table('property_cities')
            ->leftJoin('properties', 'property_cities.id', 'properties.city')
            ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_purpose', 'Sale')
            ->where('property_type', $type->id)
            ->groupBy('property_cities.name')
            ->orderBy("pcount", "DESC")
            ->get();
            
            ?>
            <?php if(!$cities->isEmpty()): ?>
                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php
                $subcities = DB::table('property_sub_cities')
                    ->leftJoin('properties', 'property_sub_cities.id', 'properties.subcity')
                    ->select('property_sub_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
                    ->where('property_sub_cities.property_cities_id', $city->id)
                    ->where("properties.status", 1)
                    ->where('property_purpose', 'Sale')
                    ->where('properties.property_type', $type->id)
                    ->groupBy("property_sub_cities.id")
                    ->orderBy("pcount", "desc")
                    ->get();
                ?>
                    <?php $__currentLoopData = $subcities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <url>
                            <loc>
                                <?php echo e(route('cpt-purpose', ['buy', Str::slug($city->slug), Str::slug($type->plural) . '-for-sale-'.$item->slug ])); ?>

                            </loc>
                            <changefreq>Daily</changefreq>
                            <priority>1</priority>
                        </url>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                    
                
            <?php endif; ?>
            
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    


    
    <?php $__currentLoopData = $rentPropertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
            $cities = DB::table('property_cities')
            ->leftJoin('properties', 'property_cities.id', 'properties.city')
            ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_purpose', 'Rent')
            ->where('property_type', $type->id)
            ->groupBy('property_cities.name')
            ->orderBy("pcount", "DESC")
            ->get();
            
            ?>
            <?php if(!$cities->isEmpty()): ?>
                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php
                    $subcities = DB::table('property_sub_cities')
                    ->leftJoin('properties', 'property_sub_cities.id', 'properties.subcity')
                    ->select('property_sub_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
                    ->where('property_sub_cities.property_cities_id', $city->id)
                    ->where("properties.status", 1)
                    ->where('property_purpose', 'Rent')
                    ->where('properties.property_type', $type->id)
                    ->groupBy("property_sub_cities.id")
                    ->orderBy("pcount", "desc")
                    ->get();
                ?>
                    <?php $__currentLoopData = $subcities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php 

                            $towns = DB::table('property_towns')
                            ->leftJoin('properties', 'property_towns.id', 'properties.town')
                            ->select('property_towns.*', DB::Raw(' COUNT(properties.id) as pcount '))
                            ->where('property_towns.property_sub_cities_id', $subcity->id)
                            ->where("properties.status", 1)
                            ->where('sub_city_slug', Str::slug($type->plural) . '-for-rent-'.$subcity->slug)
                            ->where('property_purpose', 'Rent')
                            ->where('properties.property_type', $type->id)
                            ->groupBy("property_towns.id")
                            ->orderBy("pcount", "desc")
                            ->get();

                        ?>
                            <?php $__currentLoopData = $towns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <url>
                                <loc>
                                    <?php echo e(route('cpt-purpose', ['rent', Str::slug($city->slug), Str::slug($type->plural) . '-for-rent-'.$subcity->slug.'-'.$item->slug ])); ?>

                                </loc>
                                <changefreq>Daily</changefreq>
                                <priority>1</priority>
                            </url>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                    
                
            <?php endif; ?>
            
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    

    
    <?php $__currentLoopData = $salePropertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
        <?php $cities = DB::table('property_cities')
        ->leftJoin('properties', 'property_cities.id', 'properties.city')
        ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
        ->where('property_purpose', 'Sale')
        ->where('property_type', $type->id)
        ->groupBy('property_cities.name')
        ->orderBy("pcount", "DESC")
        ->get();  ?>

            <?php if(!$cities->isEmpty()): ?>
                
                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php $subcities = DB::table('property_sub_cities')
                    ->leftJoin('properties', 'property_sub_cities.id', 'properties.subcity')
                    ->select('property_sub_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
                    ->where('property_sub_cities.property_cities_id', $city->id)
                    ->where("properties.status", 1)
                    ->where('property_purpose', 'Sale')
                    ->where('properties.property_type', $type->id)
                    ->groupBy("property_sub_cities.id")
                    ->orderBy("pcount", "desc")
                    ->get(); ?>
                    <?php $__currentLoopData = $subcities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php $towns = DB::table('property_towns')
                            ->leftJoin('properties', 'property_towns.id', 'properties.town')
                            ->select('property_towns.*', DB::Raw(' COUNT(properties.id) as pcount '))
                            ->where('property_towns.property_sub_cities_id', $subcity->id)
                            ->where("properties.status", 1)
                            ->where('sub_city_slug', Str::slug($type->plural) . '-for-sale-'.$subcity->slug)
                            ->where('property_purpose', 'Sale')
                            ->where('properties.property_type', $type->id)
                            ->groupBy("property_towns.id")
                            ->orderBy("pcount", "desc")
                            ->get(); ?>

                                <?php $__currentLoopData = $towns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <url>
                                    <loc>
                                        <?php echo e(route('cpt-purpose', ['buy', Str::slug($city->slug), Str::slug($type->plural) . '-for-sale-'.$subcity->slug.'-'.$item->slug ])); ?>

                                    </loc>
                                    <changefreq>Daily</changefreq>
                                    <priority>1</priority>
                                </url>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
            <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    


    
    <?php $__currentLoopData = $salePropertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php $cities = DB::table('property_cities')
            ->leftJoin('properties', 'property_cities.id', 'properties.city')
            ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_purpose', 'Sale')
            ->where('property_type', $type->id)
            ->groupBy('property_cities.name')
            ->orderBy("pcount", "DESC")
            ->get(); ?>

            <?php if(!$cities->isEmpty()): ?>
                
                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php $subcities = DB::table('property_sub_cities')
                    ->leftJoin('properties', 'property_sub_cities.id', 'properties.subcity')
                    ->select('property_sub_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
                    ->where('property_sub_cities.property_cities_id', $city->id)
                    ->where("properties.status", 1)
                    ->where('property_purpose', 'Sale')
                    ->where('properties.property_type', $type->id)
                    ->groupBy("property_sub_cities.id")
                    ->orderBy("pcount", "desc")
                    ->get(); ?>
                    
                    <?php $__currentLoopData = $subcities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                            <?php  $towns = DB::table('property_towns')
                            ->leftJoin('properties', 'property_towns.id', 'properties.town')
                            ->select('property_towns.*', DB::Raw(' COUNT(properties.id) as pcount '))
                            ->where('property_towns.property_sub_cities_id', $subcity->id)
                            ->where("properties.status", 1)
                            ->where('sub_city_slug', Str::slug($type->plural) . '-for-sale-'.$subcity->slug)
                            ->where('property_purpose', 'Sale')
                            ->where('properties.property_type', $type->id)
                            ->groupBy("property_towns.id")
                            ->orderBy("pcount", "desc")
                            ->get(); ?>

                            <?php $__currentLoopData = $towns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $town): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                                <?php  $areas = DB::table('property_areas')
                                ->leftJoin('properties', 'property_areas.id', 'properties.area')
                                ->select('property_areas.*', DB::Raw(' COUNT(properties.id) as pcount '))
                                ->where('property_areas.property_towns_id', $town->id)
                                ->where("properties.status", 1)
                                ->where('town_slug', Str::slug($type->plural) . '-for-sale-'.$subcity->slug.'-'.$town->slug)
                                ->where('property_purpose', 'Sale')
                                ->where('properties.property_type', $type->id)
                                ->groupBy("property_areas.id")
                                ->orderBy("pcount", "desc")
                                ->get(); ?>

                                <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <url>
                                        <loc>
                                            <?php echo e(route('cpt-purpose', ['buy', Str::slug($city->slug), Str::slug($type->plural) . '-for-sale-'.$subcity->slug.'-'.$town->slug.'-'.$item->slug ])); ?>

                                        </loc>
                                        <changefreq>Daily areas sale</changefreq>
                                        <priority>1</priority>
                                    </url>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endif; ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    


    
    <?php $__currentLoopData = $rentPropertyTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php $cities = DB::table('property_cities')
            ->leftJoin('properties', 'property_cities.id', 'properties.city')
            ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_purpose', 'Rent')
            ->where('property_type', $type->id)
            ->groupBy('property_cities.name')
            ->orderBy("pcount", "DESC")
            ->get(); ?>

            <?php if(!$cities->isEmpty()): ?>
                
                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php $subcities = DB::table('property_sub_cities')
                    ->leftJoin('properties', 'property_sub_cities.id', 'properties.subcity')
                    ->select('property_sub_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
                    ->where('property_sub_cities.property_cities_id', $city->id)
                    ->where("properties.status", 1)
                    ->where('property_purpose', 'Rent')
                    ->where('properties.property_type', $type->id)
                    ->groupBy("property_sub_cities.id")
                    ->orderBy("pcount", "desc")
                    ->get(); ?>
                    
                    <?php $__currentLoopData = $subcities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                            <?php  $towns = DB::table('property_towns')
                            ->leftJoin('properties', 'property_towns.id', 'properties.town')
                            ->select('property_towns.*', DB::Raw(' COUNT(properties.id) as pcount '))
                            ->where('property_towns.property_sub_cities_id', $subcity->id)
                            ->where("properties.status", 1)
                            ->where('sub_city_slug', Str::slug($type->plural) . '-for-rent-'.$subcity->slug)
                            ->where('property_purpose', 'Rent')
                            ->where('properties.property_type', $type->id)
                            ->groupBy("property_towns.id")
                            ->orderBy("pcount", "desc")
                            ->get(); ?>

                            <?php $__currentLoopData = $towns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $town): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                                <?php  $areas = DB::table('property_areas')
                                ->leftJoin('properties', 'property_areas.id', 'properties.area')
                                ->select('property_areas.*', DB::Raw(' COUNT(properties.id) as pcount '))
                                ->where('property_areas.property_towns_id', $town->id)
                                ->where("properties.status", 1)
                                ->where('town_slug', Str::slug($type->plural) . '-for-rent-'.$subcity->slug.'-'.$town->slug)
                                ->where('property_purpose', 'Rent')
                                ->where('properties.property_type', $type->id)
                                ->groupBy("property_areas.id")
                                ->orderBy("pcount", "desc")
                                ->get(); ?>

                                <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <url>
                                        <loc>
                                            <?php echo e(route('cpt-purpose', ['rent', Str::slug($city->slug), Str::slug($type->plural) . '-for-rent-'.$subcity->slug.'-'.$town->slug.'-'.$item->slug ])); ?>

                                        </loc>
                                        <changefreq>Daily areas rent</changefreq>
                                        <priority>1</priority>
                                    </url>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endif; ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    


    
    
    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id)); ?></loc>
     </url>  
     <p>property detail routes starts</p>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    

   


    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(url('blog/'.$blog->slug)); ?></loc>
     </url>  
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

    <?php $__currentLoopData = $agencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a => $agency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(url('agency/'.Str::slug($agency->name, "-").'/'.$agency->id)); ?></loc>
     </url>  
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

    <?php $__currentLoopData = $city_guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a => $city_guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(url('city-guide/'.$city_guide->city_slug)); ?></loc>
     </url>  
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</urlset><?php /**PATH C:\xampp 7.4\htdocs\saakin\resources\views/pages/sitemap.blade.php ENDPATH**/ ?>