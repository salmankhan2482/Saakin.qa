<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    protected $fillable = [''];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
}
