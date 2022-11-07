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
            'title'=> 'required|max:120',
            'description'=> 'required'
        ]);

        // Creates note, passing the user_id
        Tvshow::create([
            // 'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description
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
    public function show($id)
    {
        //
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
