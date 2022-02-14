<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuOptions extends Model
{
    protected $table = 'menu_options';
    protected $fillable = [''];

    public function parent()
    {
        return $this->belongsTo(MenuOptions::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(MenuOptions::class, 'parent_id');
    }
    
}
