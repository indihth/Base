<?php

namespace App\Http\Controllers\Admin;

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
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $tvshows = Tvshow::paginate(10);

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

        return view('admin.tvshows.create');
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
            'image' => 'required|file|image'
        ]);

        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $filename = date('Y-m-d-His') . '_' . $request->input('title') . '.' . $extension;

        // // referenced: https://dev.to/shanisingh03/how-to-upload-image-in-laravel-9--4dkf
        // $filename = time().'.'.$request->image->extension();

        // stores the image file in the public images folder
        $path = $image->storeAs('public/images', $filename);

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
            'image' => $filename,
            'network_id' => '1'
        ]);

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

        return view('admin.tvshows.edit')->with('tvshow', $tvshow);
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
            'difficulty' => 'required|numeric|min:1|max:10'
        ]);

        $tvshow->update([
            'title' => $request->title,
            'description' => $request->description,
            'release_date' => $request->release_date,
            'director' => $request->director,
            'rating' => $request->rating,
            'difficulty' => $request->difficulty,
            'network_id' => '1'
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

        $tvshow->delete();

        return to_route('admin.tvshows.index')->with('success', 'TV Show deleted successfully');
    }
}
