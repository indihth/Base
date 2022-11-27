<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {

        $user = Auth::user();
        $home = 'home';

        if($user->hasRole('admin')){
            $home = 'admin.tvshows.index';
        }
        else if ($user->hasRole('user')){
            $home = 'user.tvshows.index';
        }
        return redirect()->route($home);
    }

    public function networksIndex(Request $request)
    {

        $user = Auth::user();
        $home = 'home';

        if($user->hasRole('admin')){
            $home = 'admin.networks.index';
        }
        else if ($user->hasRole('user')){
            $home = 'user.networks.index';
        }
        return redirect()->route($home);
    }
}