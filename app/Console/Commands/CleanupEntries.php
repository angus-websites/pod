<?php

namespace App\Console\Commands;

use App\Models\Entry;
use App\Models\User;
use Illuminate\Console\Command;

class CleanupEntries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup:entries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all the orphaned entries from the database, i.e the ones that no longer have a user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Fetch all entries
        $entries = Entry::all();
        $counter = 0;

        // Go through and delete orphan entries
        foreach ($entries as $entry){
            $uid = $entry->user_id;
            if (User::where('id', '=', $uid)->doesntExist()) {
                $counter+=1;
                $entry->delete();
            }
        }
        echo "Deleted $counter entries\n";
        return Command::SUCCESS;
    }
}
