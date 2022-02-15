<?php

namespace App;
use App\Permissions;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    protected $fillable = [''];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }

    public function rolepermissions()
    {
        return $this->belongsToMany(Permissions::class, 'permission_role', 'role_id', 'permission_id');
    }

    public function menuoptions()
    {
        return $this->belongsToMany(MenuOptions::class,'menu_option_role','role_id', 'menu_option_id');
    }
}
