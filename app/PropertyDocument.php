<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyDocument extends Model
{
    protected $table = 'property_documents';

    protected $fillable = ['property_id','doc_images'];

    public $timestamps = false;
}
