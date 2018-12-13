<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'user_id', 'status_owner_vehicle',
    ];

    protected $table = 'owner_vehicle';

    
}
