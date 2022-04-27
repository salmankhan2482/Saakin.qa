<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaveProperties extends Model
{
    protected $table = 'save_properties';
    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
