<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'city_name_ru',
        'city_name_en',
        'city_has_connection'
    ];

    function city () {
        return $this->hasMany('App\Models\CityCountryLink');
    }
}
