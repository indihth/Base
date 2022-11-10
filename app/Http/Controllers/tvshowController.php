<?php

namespace App\Http\Controllers;

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

        ///////////////////////////////////////
        // display only notes for logged in user
        // latest, sorted by the 'update_at' column
        // $notes = Note::where('user_id', Auth::id())->latest('updated_at')->get();

        ///////////////////////////////////////
        // paginate added to display only 'x' amount of notes per page
        // paginate() take arguement, num of notes to be displayed

        $tvshows =  Tvshow::where('user_id', Auth::id())->latest('updated_at')->paginate(5);

        // shows the index view and displays the tv shows from the above variable
        return view('tvshows.index')->with('tvshows', $tvshows);

        ///////////////////////////////////////
        // alternatively, can use include in view()
        // return view('notes.index', $notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tvshows.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validates the fields are filled, title max 120 char
        $request->validate([
            'title' => 'required|max:120',
            'description' => 'required',
            'release_date' => 'required|date',
            'director' => 'required|max:120',

            // if 'numeric' is not included the input values will be treated as characters
            // https://www.youtube.com/watch?v=SY375k_BFYU
            'rating' => 'required|numeric|min:1|max:5',
            'difficulty' => 'required|numeric|min:1|max:10'
        ]);

        // Creates and saves note, passing the user_id
        Tvshow::create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'release_date' => $request->release_date,
            'director' => $request->director,
            'rating' => $request->rating,
            'difficulty' => $request->difficulty,
        ]);

        // Return to the notes page after note is added
        return to_route('tvshows.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tvshow $tvshow)
    {
        /////////////////////////////
        // Route Model Binding
        // Can replace show($uuid) and inject Tvshow directly instead of querying.
        // Alt code: 
        // $tvshow = Tvshow::where('uuid', $uuid)->where('user_id', Auth::id())->firstOrFail();
        /////////////////////////////


        // if($tvshows->user_id != Auth::id()) {
        //     //403 error forbidden
        //     return abort(403);
        // }

        /////////////////////////////
        // Auth::id() needed to only show authorised users tvshow.
        // Otherwise user could put any tvshow id in url and access it.
        // FURTHER READING - laravel Gates and Policies
        // firstOrFail displays a 404 error if the first tvshow is unavailable.
        /////////////////////////////

        // Return the tvshow view page with variable 'tvshow'
        return view('tvshows.show')->with('tvshow', $tvshow);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
