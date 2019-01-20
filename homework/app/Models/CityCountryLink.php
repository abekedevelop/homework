<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityCountryLink extends Model
{
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'city_id',
        'country_id'
    ];

    function country () {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }
}
