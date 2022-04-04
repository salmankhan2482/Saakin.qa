<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{$site_url}}</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    
    <url>
        <loc>{{$site_url}}/properties</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{$site_url}}/featured-properties</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
   
    <url>
        <loc>{{$site_url}}/about-us</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{$site_url}}/terms-of-use</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{$site_url}}/faqs</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    
    <url>
        <loc>{{$site_url}}/privacy-policy</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{$site_url}}/contact-us</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{$site_url}}/blog</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{$site_url}}/real-estate-agencies</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>{{$site_url}}/city-guide</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>


    {{-- START BUY PROPERTY FIRST PAGE URL --}}
    <url>
        <loc>{{$site_url}}/buy/properties-for-sale</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    {{-- END BUY PROPERTY FIRST PAGE URL --}}


    {{-- START RENT PROPERTY FIRST PAGE URL --}}
    <url>
        <loc>{{$site_url}}/rent/properties-for-rent</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
    </url>
    {{-- END BUY PROPERTY FIRST PAGE URL --}}


    {{-- second url for sale starts --}}
    @foreach($salePropertyTypes as $p => $propertyType)
    <url>
        <loc>{{ route('property-type-purpose',['buy', Str::slug($propertyType->plural) . '-for-sale']) }}</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
     </url>  
    @endforeach
    {{-- second url for sale ends --}}

    

    {{-- second url for rent starts --}}
    @foreach($rentPropertyTypes as $p => $propertyType)
    <url>
        <loc>{{ route('property-type-purpose',['rent', Str::slug($propertyType->plural) . '-for-rent']) }}</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
     </url>  
    @endforeach 
    {{-- second url for rent ends --}}


    {{-- third url for rent properties of a city --}}
    @foreach ($rentPropertyTypes as $type)
            <?php  $cities = DB::table('property_cities')
            ->leftJoin('properties', 'property_cities.id', 'properties.city')
            ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_purpose', 'Rent')
            ->where('property_type', $type->id)
            ->groupBy('property_cities.name')
            ->orderBy("pcount", "DESC")
            ->get(); ?>
            
            @if(!$cities->isEmpty())
                @foreach ($cities as $item)
                <url>
                    <loc>
                        {{ route('cpt-purpose', ['rent', Str::slug($item->slug), Str::slug($type->plural) . '-for-rent' ]) }}
                    </loc>
                    <changefreq>Daily</changefreq>
                    <priority>1</priority>
                </url>
                @endforeach    
                
            @endif
            
    @endforeach
    

    {{-- third url for sale properties of a city --}}
    @foreach ($salePropertyTypes as $type)
            <?php $cities = DB::table('property_cities')
            ->leftJoin('properties', 'property_cities.id', 'properties.city')
            ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_purpose', 'Sale')
            ->where('property_type', $type->id)
            ->groupBy('property_cities.name')
            ->orderBy("pcount", "DESC")
            ->get(); ?>

            @if(!$cities->isEmpty())
                @foreach ($cities as $item)
                <url>
                    <loc>
                        {{ route('cpt-purpose', ['buy', Str::slug($item->slug), Str::slug($type->plural) . '-for-sale' ]) }}
                    </loc>
                    <changefreq>Daily</changefreq>
                    <priority>1</priority>
                </url>
                @endforeach    
                
            @endif
            
    @endforeach
    
    {{-- forth url for rent properties of a city->subcity --}}
    @foreach ($rentPropertyTypes as $type)
            <?php $cities = DB::table('property_cities')
            ->leftJoin('properties', 'property_cities.id', 'properties.city')
            ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_purpose', 'Rent')
            ->where('property_type', $type->id)
            ->groupBy('property_cities.name')
            ->orderBy("pcount", "DESC")
            ->get(); ?>

            @if(!$cities->isEmpty())
                @foreach ($cities as $city)

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
                    @foreach ($subcities as $item)
                        <url>
                            <loc>
                                {{ route('cpt-purpose', ['rent', Str::slug($city->slug), Str::slug($type->plural) . '-for-rent-'.$item->slug ]) }}
                            </loc>
                            <changefreq>Daily</changefreq>
                            <priority>1</priority>
                        </url>
                    @endforeach
                
                @endforeach   
                
            @endif
            
    @endforeach
    {{-- forth url for rent properties of a city->subcity ends  --}}


    {{-- forth url for sale properties of a city->subcity --}}
    @foreach ($salePropertyTypes as $type)
            <?php $cities = DB::table('property_cities')
            ->leftJoin('properties', 'property_cities.id', 'properties.city')
            ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_purpose', 'Sale')
            ->where('property_type', $type->id)
            ->groupBy('property_cities.name')
            ->orderBy("pcount", "DESC")
            ->get(); ?>

            @if(!$cities->isEmpty())
                
                @foreach ($cities as $city)

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
                    
                    @foreach ($subcities as $item)
                        <url>
                            <loc>
                                {{ route('cpt-purpose', ['buy', Str::slug($city->slug), Str::slug($type->plural) . '-for-sale-'.$item->slug ]) }}
                            </loc>
                            <changefreq>Daily</changefreq>
                            <priority>1</priority>
                        </url>
                    @endforeach
                
                @endforeach   
                
            @endif
            
    @endforeach
    {{-- forth url for sale properties of a city->subcity ends  --}}


    {{-- fifth url for rent properties of a city->subcity->town --}}
    @foreach ($rentPropertyTypes as $type)
            <?php $cities = DB::table('property_cities')
            ->leftJoin('properties', 'property_cities.id', 'properties.city')
            ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_purpose', 'Rent')
            ->where('property_type', $type->id)
            ->groupBy('property_cities.name')
            ->orderBy("pcount", "DESC")
            ->get(); ?>

            @if(!$cities->isEmpty())
                
                @foreach ($cities as $city)

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

                    @foreach ($subcities as $subcity)

                        <?php $towns = DB::table('property_towns')
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

                        @foreach ($towns as $item)
                        <url>
                            <loc>
                                {{ route('cpt-purpose', ['rent', Str::slug($city->slug), Str::slug($type->plural) . '-for-rent-'.$subcity->slug.'-'.$item->slug ]) }}
                            </loc>
                            <changefreq>Daily</changefreq>
                            <priority>1</priority>
                        </url>
                        @endforeach
                            
                    @endforeach
                
                @endforeach   
                
            @endif
            
    @endforeach
    {{-- fifth url for rent properties of a city->subcity->town ends  --}}

    {{-- fifth url for sale properties of a city->subcity->town --}}
    @foreach ($salePropertyTypes as $type)
            
        <?php $cities = DB::table('property_cities')
        ->leftJoin('properties', 'property_cities.id', 'properties.city')
        ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
        ->where('property_purpose', 'Sale')
        ->where('property_type', $type->id)
        ->groupBy('property_cities.name')
        ->orderBy("pcount", "DESC")
        ->get();  ?>

            @if(!$cities->isEmpty())
                
                @foreach ($cities as $city)

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
                    @foreach ($subcities as $subcity)

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

                                @foreach ($towns as $item)
                                <url>
                                    <loc>
                                        {{ route('cpt-purpose', ['buy', Str::slug($city->slug), Str::slug($type->plural) . '-for-sale-'.$subcity->slug.'-'.$item->slug ]) }}
                                    </loc>
                                    <changefreq>Daily</changefreq>
                                    <priority>1</priority>
                                </url>
                                @endforeach

                    @endforeach
                @endforeach   
            @endif
    @endforeach
    {{-- fifth url for sale properties of a city->subcity->town ends  --}}

    {{-- sixth url for rent properties of a city->subcity->town->area --}}
    @foreach ($rentPropertyTypes as $type)

        <?php $cities = DB::table('property_cities')
        ->leftJoin('properties', 'property_cities.id', 'properties.city')
        ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
        ->where('property_purpose', 'Rent')
        ->where('property_type', $type->id)
        ->groupBy('property_cities.name')
        ->orderBy("pcount", "DESC")
        ->get(); ?>

        @if(!$cities->isEmpty())
            
            @foreach ($cities as $city)

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
                
                    @foreach ($subcities as $subcity)
                    
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

                        @foreach ($towns as $town)
                        
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

                            @foreach ($areas as $item)
                                <url>
                                    <loc>
                                        {{ route('cpt-purpose', ['rent', Str::slug($city->slug), Str::slug($type->plural) . '-for-rent-'.$subcity->slug.'-'.$town->slug.'-'.$item->slug ])  }}
                                    </loc>
                                    <changefreq>Daily</changefreq>
                                    <priority>1</priority>
                                </url>
                            @endforeach

                        @endforeach

                    @endforeach

            @endforeach

        @endif

    @endforeach
    {{-- sixth url for rent properties of a city->subcity->town->area ends  --}}

    {{-- sixth url for sale properties of a city->subcity->town --}}
    @foreach ($salePropertyTypes as $type)

            <?php $cities = DB::table('property_cities')
            ->leftJoin('properties', 'property_cities.id', 'properties.city')
            ->select('property_cities.*', DB::Raw(' COUNT(properties.id) as pcount '))
            ->where('property_purpose', 'Sale')
            ->where('property_type', $type->id)
            ->groupBy('property_cities.name')
            ->orderBy("pcount", "DESC")
            ->get(); ?>

            @if(!$cities->isEmpty())
                
                @foreach ($cities as $city)

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
                    
                    @foreach ($subcities as $subcity)
                        
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

                            @foreach ($towns as $town)
                            
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

                                @foreach ($areas as $item)
                                    <url>
                                        <loc>
                                            {{ route('cpt-purpose', ['buy', Str::slug($city->slug), Str::slug($type->plural) . '-for-sale-'.$subcity->slug.'-'.$town->slug.'-'.$item->slug ])  }}
                                        </loc>
                                        <changefreq>Daily</changefreq>
                                        <priority>1</priority>
                                    </url>
                                @endforeach

                            @endforeach

                    @endforeach

                @endforeach

            @endif

    @endforeach
    {{-- sixth url for sale properties of a city->subcity->town ends  --}}


   

    
    {{-- property detail routes starts --}}
    @foreach($properties as $i => $property)
    <url>
        <loc>{{ url(strtolower($property->property_purpose) . '/' . $property->property_slug . '/' . $property->id) }}</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
     </url>  
    @endforeach 
    {{-- property detail routes ends --}}

   


    @foreach($blogs as $b => $blog)
    <url>
        <loc>{{url('blog/'.$blog->slug)}}</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
     </url>  
    @endforeach 

    @foreach($blog_categories as $bc => $blog_category)
    <url>
        <loc>{{url('blog-categories/'.$blog_category)}}</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
     </url>  
    @endforeach 

    @foreach($agencies as $a => $agency)
    <url>
        <loc>{{url('agency/'.Str::slug($agency->name, "-").'/'.$agency->id)}}</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
     </url>  
    @endforeach 

    @foreach($city_guides as $a => $city_guide)
    <url>
        <loc>{{url('city-guide/'.$city_guide->city_slug)}}</loc>
        <changefreq>Daily</changefreq>
        <priority>1</priority>
     </url>  
    @endforeach
</urlset>