<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Eloquent
{
    use SoftDeletes, DynamicFillable, UserTimezone;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'seq', 'name', 'email', 'phone', 'source', 'received_agent', 'forward_agent', 'property_link', 'message', 'status', 'created_by', 'updated_by'
    ];

    protected $appends = ['status_name'];



    public function creator()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
    public function receiver()
    {
        return $this->belongsTo('App\User', 'received_agent', 'id');
    }
    public function forwarder()
    {
        return $this->belongsTo('App\User', 'forward_agent', 'id');
    }

    public function modifier()
    {
        return $this->belongsTo('App\User', 'updated_by', 'id');
    }

}
