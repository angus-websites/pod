<?php

namespace App\Http\Controllers;

use App\Http\Resources\EntryResource;

use App\Http\Resources\TemplateResource;

use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\Template;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
    public function index(Request $request)
    {

        $filters = $request->only(['search']);
        $entries =  EntryResource::collection(
            Auth::user()->entries()->when($request->input('search'), function($query, $search){
                return $query->where('data.title', 'like', "%${search}%");
            })->paginate(15)->withQueryString()
        );
        return Inertia::render('Entry/Index', ['entries' => $entries, 'filters' => $filters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $new_entry = new Entry();
        $templates = Template::all();
        return Inertia::render('Entry/Create', ["new_entry" => $new_entry, "templates" =>  $templates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  

        // Fetch the template to avoid using client side details
        $template = Template::findOrFail($request->template);

        // Extract the validation rules
        $template->getValidator($request->content)->validate();

        // Convert content into data
        $request->merge(['data' => $request->content, 'title' => $request->content['title']]);

        // Create the new Entry
        $new_entry = new Entry();
        $new_entry->fill($request->all());
        $new_entry->user_id = Auth::user()->id;
        $new_entry->template_id = $template->id;
        $new_entry->save();

        // If we pass validation
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

        return Inertia::render('Entry/View', [
            'entry' => $ent,
            'can' => ['deleteEntry' => Auth::user()->can('delete', $entry)],
        ]);
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

        // Fetch the template
        $template = $entry->template();        

        // Extract the validation rules & run
        $template->getValidator(array_merge($request->content, ["title" => $request->title]))->validate();

        // Update the model
        $input = array_merge(["data" => $request->content], ["title" => $request->title]);

        $entry->fill($input)->save();

        // If we pass validation
        return Redirect::back()->with('success', 'Entry updated');
        //Log::info("Entry updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Entry $entry)
    {
        $entry->delete();

        return Redirect::route('entries.index')->with('info', 'Entry deleted');

    }
}
