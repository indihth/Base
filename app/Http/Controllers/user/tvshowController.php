<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tvshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class tvshowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tvshows = Tvshow::paginate(10);

        return view('user.tvshows.index')->with('tvshows', $tvshows);

    }

    public function show(Tvshow $tvshow)
    {
        return view('user.tvshows.show')->with('tvshow', $tvshow);
    }
}
