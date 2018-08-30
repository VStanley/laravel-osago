<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regions extends Model
{
    protected $table = 'regions';

    protected $fillable = [
        'region'
    ];


    public function cityCoefficient()
    {
        return $this->hasMany('App\Models\City_coefficient');
    }


}
