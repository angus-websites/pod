<?php

namespace App\Console\Commands;

use App\Models\Entry;
use App\Models\User;
use Illuminate\Console\Command;

class UpdateEntriesDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:entries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Fetch all entries
        $entries = Entry::all();

        // Go through and delete orphan entries
        foreach ($entries as $entry){
            $d = $entry->data["date"];
            $entry->created_at = $d;
            $entry->updated_at = $d;
            $entry->save();
        }

        return Command::SUCCESS;
    }
}
