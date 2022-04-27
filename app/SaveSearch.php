<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaveSearch extends Model
{
    protected $table = 'save_search';
    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
