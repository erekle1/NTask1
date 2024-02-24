<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{

    protected $fillable = [
        'title', 'end_date', 'uuid'
    ];

    protected $casts = [
        "end_date" => "date",
    ];

    public function steps(){
        return $this->hasMany('App\Models\Step');
    }

}
