<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StepField extends Model
{
    protected $fillable = [
    	'step_id', 'input'
    ];

    protected static $availableInputs = [
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
    ];


    public static function getAvailableInputs()
    {
        return self::$availableInputs;
    }


}
