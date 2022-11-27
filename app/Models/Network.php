<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory;

    // Specify the fields that CAN NOT be mass assigned
    // by using the $guarded variable
    // an empty array allows for all fields to be mass assigned
    protected $guarded = [];

    // One to Many relationship
    // Enables 
    public function tvshows()
    {
        return $this->hasMany('App\Models\Tvshow');
    }
}
