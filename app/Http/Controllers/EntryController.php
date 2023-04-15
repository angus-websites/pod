<?php

namespace App\Http\Controllers;

use App\Http\Resources\EntryResource;

use App\Http\Resources\TemplateResource;

use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\Template;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
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
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'template', 'sortBy']);
        $entries =  EntryResource::collection(
            Auth::user()->entries()
            ->when($request->input('search'), function($query, $search){
                return $query->where('data.title', 'like', "%${search}%");
            })->when($request->input('template'), function($query, $template){
                return $query->where('template_id', '=', $template);
            })->when($request->input('sortBy'), function($query, $sortBy){
                switch ($sortBy) {
                    case 'newest':
                        return $query->orderBy("data.date", "desc");
                    case 'oldest':
                        return $query->orderBy("data.date", "asc");
                    case 'title':
                        return $query->orderBy("data.title", "asc");
                    default:
                        return $query->orderBy("created_at", "asc");
                }
            })->orderBy("created_at", "desc")->paginate(15)->withQueryString()
        );

        // Fetch the templates (->all() removes the 'data' key)
        $templates = TemplateResource::collection(Template::all())->all();
        return Inertia::render('Entry/Index', ['entries' => $entries, 'filters' => $filters, "templates" => $templates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $new_entry = new Entry();
        $templates = TemplateResource::collection(Template::all())->all();
        return Inertia::render('Entry/Create', ["new_entry" => $new_entry, "templates" =>  $templates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        // Fetch the template to avoid using client side details
        $template = Template::findOrFail($request->template);

        // Extract the validation rules
        $template->getValidator($request->content)->validate();

        // Convert the array content into "data"
        $input = ["data" => $request->content];

        // Create the new Entry
        $new_entry = new Entry();
        $new_entry->fill($input);
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
     * @return \Inertia\Response
     */
    public function show(Entry $entry){

        $ent = new EntryResource($entry);
        $template = new TemplateResource($entry->template());

        return Inertia::render('Entry/View', [
            'entry' => $ent,
            'can' => [
                'deleteEntry' => Auth::user()->can('delete', $entry),
                'editEntry' => Auth::user()->can('update', $entry),
            ],
            'template' => $template,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Entry $entry)
    {

        // Fetch the template
        $template = $entry->template();

        // Extract the validation rules & run
        $template->getValidator($request->content)->validate();

        // Convert the array content into "data"
        $input = ["data" => $request->content];

        $entry->fill($input)->save();

        // If we pass validation
        return Redirect::back()->with('success', 'Entry updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Entry $entry)
    {
        $entry->delete();

        return Redirect::route('entries.index')->with('info', 'Entry deleted');

    }
}
