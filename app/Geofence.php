<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Geofence extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'latitude','longitude','radio','group_id'
   ];

   protected $table = 'geofence';
}
