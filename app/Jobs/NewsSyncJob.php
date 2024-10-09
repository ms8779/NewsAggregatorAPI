<?php

namespace App\Jobs;

use App\Services\NewsOrgService;
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
            case 'news_org':
                app(NewsOrgService::class)->fetchAndSave();
                break;
        }
    }
}
