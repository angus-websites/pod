<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CVController extends Controller
{
    // Minimum number of entries required to generate a CV
    public static int $minEntries = 5;

    /**
     * Show the CV builder page
     *
     * @return \Inertia\Response
     */
    public function index()
    {

        // Check permissions before rendering feedback form
        if (! Gate::allows('access-cv', Auth::user())) {
            abort(403);
        }

        // Get number of entries
        $numberOfEntries = Auth::user()->entries()->count();

        return Inertia::render('CV/Index', [
            "numberOfEntries" => $numberOfEntries,
            "minEntries" => self::$minEntries,
            "data" => Inertia::lazy(fn () => $this->getCV()),
            ]);
    }


    /**
     * Use OpenAI to generate a CV from
     * all the users content
     */
    private function getCV(){

        $user = Auth::user();

        //Abort if this user does not have enough entries
        if ($user->entries()->count() < $this::$minEntries){
            abort(403, "This user does not have enough entries to generate a CSV");
        }

        // Generate a prompt to be lazy loaded
        $prompt = "Generate a CV for me based on the following diary entries in raw html (body only)... \n";

        // Fill basic information in
        $prompt.="Basic info...\n";
        $prompt.="Name: ".$user->name."\n";
        $prompt.="Email: ".$user->email."\n";

        $counter = 0;
        // Generate the message to ask
        foreach ($user->entries()->get() as $entry) {
            $counter ++;
            $prompt.="\nEntry $counter\n";
            $prompt.=$entry->stringify();
        }

        // Send to ChatGPT

        $messages = [
            ['role' => 'user', 'content' => $prompt,
        ]];

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages,
        ]);

        return Arr::get($result, 'choices.0.message');
    }

    /**
     * Take the user generated HTML
     * and convert it to PDF
     */
    public function createPDF(Request $request){

        // Check permissions before rendering feedback form
        if (! Gate::allows('access-cv', Auth::user())) {
            abort(403);
        }


        $cvContent = $request->cvContent;

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($cvContent);

        // return $pdf->stream(); // Just stream the data without download

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'cv.pdf', ['Content-Type' => 'application/pdf']);

    }



}
