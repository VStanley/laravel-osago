<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City_coefficient extends Model
{
    protected $table = 'city_coefficients';

    protected $fillable = [
        'regions_id',
        'location',
        'auto',
        'tractor'
    ];


    public function regions()
    {
        return $this->belongsTo('App\Models\Regions');
    }
}
