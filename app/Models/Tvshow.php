<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tvshow extends Model
{
    use HasFactory;

    // Specify the fields that CAN NOT be mass assigned
    // by using the $guarded variable
    // an empty array allows for all fields to be mass assigned
    protected $guarded = [];


    ////////////////////////////////
    // Specify field that CAN be mass assigned
    // with the $ fillable variable
    //
    // protected $fillable = [];
    ////////////////////////////////

    ////////////////////////////////
    // Because I've passed Tvshow directly into show() in tvshowController
    // it uses tvshow->id by default, 
    // this changes the default to use tvshow->uuid
    ////////////////////////////////
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
