<?php

namespace App\Console\Commands;

use App\Jobs\NewsSyncJob;
use App\Services\NewYorkTimesService;
use App\Services\TheGuardianService;
use Illuminate\Console\Command;

class FetchNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newsSources = ['news_org', 'the_guardian', 'ny_times'];

        foreach ($newsSources as $ns){
            NewsSyncJob::dispatch($ns);
        }
    }
}
