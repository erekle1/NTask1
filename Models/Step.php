<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{

    protected $fillable = [
    	'title', 'campaign_id', 'order_num', 'fileName'
    ];

    public function campaign(){
        return $this->belongsTo('App\Models\Campaign');
    }

    public function fields(){
        return $this->hasMany('App\Models\StepField');
    }

}
