<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    use HasFactory;

    protected $fillable = [
        'salutation',
        'firstname',
        'lastname',
        'email',
        'date_of_birth',
        'phone',
        'street',
        'postal_code',
        'city',
        'country',
        'campaign_id', // Assuming each participation is linked to a campaign
    ];

    public function campaign(){
        return $this->belongsTo('App\Models\Campaign');
    }



}
