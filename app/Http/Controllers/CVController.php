<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Http\Request;

class CVController extends Controller
{
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

        return Inertia::render('CV/Index', ["data" => Inertia::lazy(fn () => $this->getCV())]);
    }

    /**
     * Take the user generated HTML
     * and convert it to PDF
     */
    public function createPDF(Request $request){
       echo "hi";
    }

    /**
     * Use OpenAI to generate a CV from
     * all the users content
     */
    private function getCV(){


        $user = Auth::user();

        // Generate a prompt to be lazy loaded
        $prompt = "Generate a CV for me based on the following diary entries and send the result back as raw html... \n";

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


}
