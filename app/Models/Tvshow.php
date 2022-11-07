<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tvshow extends Model
{
    use HasFactory;

    // changes id to uuid in URL
    // public function getRouteKeyName()
    // {
    //     return 'uuid';
    // }
}
