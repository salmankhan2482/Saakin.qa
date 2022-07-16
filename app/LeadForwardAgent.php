<?php

namespace App;

use App\Lead;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadForwardAgent extends Model
{
   use SoftDeletes;
    protected $guarded = '';
    protected $table = 'lead_forward_agent';

    public function lead()
    {
      return $this->belongsTo(Lead::class, 'lead_id');
    }
    
    public function agency()
    {
      return $this->belongsTo(Agency::class, 'agency_id');
    }
    
}
