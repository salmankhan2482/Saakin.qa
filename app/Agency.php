<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = 'agencies';

	public $timestamps = false;


    public static function agencyImage($image)
    {
        $fullpath = public_path().'/upload/agencies/'.$image;
        if(!empty($image))
        {
            if(file_exists($fullpath))
            {
                return asset('/upload/agencies/'.$image);
            }
            else
            {
                return asset('/upload/agencies/nopicture.jpg');
            }
        }
        else
        {
            return asset('/upload/agencies/nopicture.jpg');
        }
    }

    public function Properties(){
        return $this->hasMany('App\Properties');
    }


}
