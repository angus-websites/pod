<?php

namespace App\Http\Controllers;

use App\Http\Resources\EntryResource;
use App\Http\Resources\EntryCollection;
use Illuminate\Http\Request;
use App\Models\Entry;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Entry::class);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $entries =  new EntryCollection(Auth::user()->entries()->paginate(2));
        return Inertia::render('Entry/Index', ['entries' => $entries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $new_entry = new Entry();
        return Inertia::render('Entry/Create', ["new_entry" => $new_entry]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
                'title' => ['required', 'max:100'],
                'date' => ['required', 'date'],
                'content' => ['required', 'max:3000'],
        ]);

        // Create the new Entry
        $new_entry = new Entry;
        $new_entry->fill($request->all());
        $new_entry->user_id = Auth::user()->id;
        $new_entry->save();

        // Redirect
        return Redirect::route('entries.index')->with('success', 'Entry created');

    }

    /**
     * Display the specified resource.
     *
     * @param  entry  $entry
     * @return EntryResource
     */
    public function show(Entry $entry){

        $ent = new EntryResource($entry);
        return Inertia::render('Entry/View', ['entry' => $ent]);
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
    public function update(Request $request, Entry $entry)
    {

        $entry->update(
            $request->validate([
                'title' => ['required', 'max:100'],
                'date' => ['required', 'date'],
                'content' => ['required', 'max:3000'],
            ])
        );
        return Redirect::back()->with('success', 'Entry updated');
        //Log::info("Entry updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $entry = Entry::findOrFail($id);
        $entry->delete();

        return response()->json(null, 204);
    }
}
