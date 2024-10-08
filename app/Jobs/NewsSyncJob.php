<?php

namespace App\Jobs;

use App\Services\NewsOrgService;
use App\Services\NewYorkTimesService;
use App\Services\TheGuardianService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;


class NewsSyncJob implements ShouldQueue
{
    use Queueable;

    private $sourceName;

    /**
     * Create a new job instance.
     */
    public function __construct($sourceName)
    {
        $this->sourceName = $sourceName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        switch ($this->sourceName) {
            case 'the_guardian':
                app(TheGuardianService::class)->fetchAndSave();
                break;
            case 'ny_times':
                app(NewYorkTimesService::class)->fetchAndSave();
                break;
            case 'news_org':
                app(NewsOrgService::class)->fetchAndSave();
                break;
        }
    }
}
