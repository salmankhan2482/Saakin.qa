<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XmlGallery extends Model
{
    protected $table ="xml_gallery";

    protected $fillable = [
 
       'reference_number', 'gallery_images'
       
       ];
}
