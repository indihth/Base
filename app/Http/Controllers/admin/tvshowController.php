<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Network;
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
        $user = Auth::user();
        $user->authorizeRoles('admin');

        // pagination won't work/isn't necessary with get()
        $tvshows = Tvshow::with('network')
            ->with('actors')
            ->latest()
            ->paginate(5);


        return view('admin.tvshows.index')->with('tvshows', $tvshows);
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
        $actors = Actor::all();

        return view('admin.tvshows.create')
            ->with('networks', $networks)
            ->with('actors', $actors);
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
            'description' => 'required',
            'release_date' => 'required|date',
            'director' => 'required|max:120',

            // if 'numeric' is not included the input values will be treated as characters
            // https://www.youtube.com/watch?v=SY375k_BFYU
            'rating' => 'required|numeric|min:1|max:5',
            'difficulty' => 'required|numeric|min:1|max:10',
            'image' => 'file|image',

            // feed network ids as only valid options
            'network_id' => 'required',

            // checks that the actors id exist in db
            'actors' => ['required', 'exists:actors,id']   

        ]);

        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();

        $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.' . $extension;

        $path = $image->storeAs('public/images', $filename);

        // // // referenced: https://dev.to/shanisingh03/how-to-upload-image-in-laravel-9--4dkf
        // $filename = time().'.'.$request->image->extension();

        // // stores the image file in the public images folder
        // $path = $image->storeAs('public/storage/images', $filename);

        // Creates and saves note, passing the user_id
        $tvshow = Tvshow::create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'release_date' => $request->release_date,
            'director' => $request->director,
            'rating' => $request->rating,
            'difficulty' => $request->difficulty,
            'image' => $filename,
            'network_id' => $request->network_id
        ]);

        // calls the actors() function in Tvshow model
        // which adds the entries to the pivot table actor_tvshow
        $tvshow->actors()->attach($request->actors);

        // Return to the notes page after note is added
        return to_route('admin.tvshows.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tvshow $tvshow)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        return view('admin.tvshows.show')->with('tvshow', $tvshow);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tvshow $tvshow)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $actors = Actor::all();

        // $tvshow = Tvshow::with('network')->get();

        return view('admin.tvshows.edit')
            ->with('tvshow', $tvshow)
            ->with('actors', $actors);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tvshow $tvshow)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');


        $request->validate([
            'title' => 'required|max:120',
            'description' => 'required',
            'release_date' => 'required|date',
            'director' => 'required|max:120',
            'rating' => 'required|numeric|min:1|max:5',
            'difficulty' => 'required|numeric|min:1|max:10',
            // 'network_id' => 'required'
        ]);

        $tvshow->update([
            'title' => $request->title,
            'description' => $request->description,
            'release_date' => $request->release_date,
            'director' => $request->director,
            'rating' => $request->rating,
            'difficulty' => $request->difficulty,
            // 'network_id' => $request->network_id
        ]);

        return to_route('admin.tvshows.show', $tvshow)->with('success', 'TV Show updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tvshow $tvshow)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        ///////////////////////////////////////////
        // FUNCTIONALITY MOVED TO NETWORK CONTROLLER
        ///////////////////////////////////////////
        // Check if $tvshows contains more than one show
        // if (!$tvshow == Tvshow::class) {
        //     dd(" == 0");
        //     dd($tvshow->count());
        //     // dd($tvshow->count());
        //     foreach ($tvshow as $tvshow) {
        //         $tvshow->delete();
        //     }
        //     return to_route('admin.network.index')->with('success', 'Network and TV Shows deleted successfully');
        // }

        // Flash messages from 'Laracast Easy Flash Messages'
        flash('TV Show deleted')->success();

        $tvshow->delete();

        return to_route('admin.tvshows.index');
    }


    ///////////////////////////////////////////
    // FUNCTION NO LONGER NEEDED
    ///////////////////////////////////////////
    // public function multiDestroy($network)
    // {
    //     // $user = Auth::user();
    //     // $user->authorizeRoles('admin');

    
    //     $networkShows = Tvshow::where('network_id', $network->id)->get();

    //     // dd($networkShows);

    //     foreach ($networkShows as $tvshow) {
    //         $tvshow->delete();
    //     }

    //     // $network->delete();

    //     // return;
    //     return to_route('admin.network.index')->with('success', 'Network and TV Shows deleted successfully');
    // }
}
