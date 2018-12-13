<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'imei', 'status_vehicle','owner_vehicle_id','device_count_id','group_id'
   ];

   protected $table = 'vehicle';
}
