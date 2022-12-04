<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Network;
use App\Models\Tvshow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $networks = Network::latest()->paginate(5);

        return view('admin.networks.index')->with('networks', $networks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $networks = Network::all();

        return view('admin.networks.create')->with('networks', $networks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Validates the fields are filled, title max 120 char
        $request->validate([
            'title' => 'required|max:120',
            'manager' => 'required',
            'location' => 'required'
        ]);

        Network::create([
            'title' => $request->title,
            'manager' => $request->manager,
            'location' => $request->location
        ]);

        return to_route('admin.networks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Network $network)
    {
        // $networkShows = Tvshow::where('network_id', $network->id)->get();

        $user = Auth::user();
        $user->authorizeRoles('admin');

        if(!Auth::id()) {
            return abort(403);
        }

        return view('admin.networks.show')->with('network', $network);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Network $network)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // $tvshow = Tvshow::with('network')->get();

        return view('admin.networks.edit')->with('network', $network);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Network $network)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // Validates the fields are filled, title max 120 char
        $request->validate([
            'title' => 'required|max:120',
            'manager' => 'required',
            'location' => 'required'
        ]);

        $network->update([
            'title' => $request->title,
            'manager' => $request->manager,
            'location' => $request->location
        ]);

        return to_route('admin.networks.show', $network)->with('success', 'Network updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Network $network)
    {
        // Can't delete a network without first removing 
        // foreign keys from tvshows. Deleting network would
        // break database integrity

        // only allow delete if network isn't
        // used as foreign key in a tvshow

        $user = Auth::user();
        $user->authorizeRoles('admin');

        $networkShows = Tvshow::where('network_id', $network->id)->get();

        if(empty($networkShows)) {
            $network->delete();
            
            flash('Network deleted')->success();

            return to_route('admin.networks.show');
            // return to_route('admin.networks.index')->with('success', 'Network deleted successfully');
        }

        // $network->tvshows->multiDestroy($networkShows);

        // flash("Deleted Network and")->success();

        return view('admin.networks.showsDelete')->with('networkShows', $networkShows)->with('network', $network);
        
        // return to_route('admin.networks.index')->with('success', "didn't work");

        // redirect to display page with related TV Shows?
        // return redirect()->to('/contact-form-success');
    }
}
