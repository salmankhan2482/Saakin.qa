<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';

	public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function BlogCategory()
    {
        return $this->belongsTo('App\BlogCategory', 'category_id', 'id');
    }

}
