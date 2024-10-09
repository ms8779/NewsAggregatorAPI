<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Services\NewsService;

class TheGuardianService
{
    private array $queryStr;

    public function __construct()
    {
        $this->queryStr = [
            'api-key' => env('THE_GUARDIAN_KEY'),
            'show-fields' => 'headline',
            'from-date' => Carbon::yesterday()->format('Y-m-d'),
            'to-date' => Carbon::today()->format('Y-m-d'),
            'page' => 1,
            'page-size' => 100
        ];
    }

    public function fetchAndSave(){
        $response = Http::get(
            'http://content.guardianapis.com/search',
            $this->queryStr
        );

        $response = $response->json('response');
        $tNews = $response['results'];

        $newsData = [];
        foreach ($tNews as $news) {
            $newsData[] = [
                'article' => [
                    'title' => $news['webTitle'],
                    'description' => $news['fields']['headline'],
                    'published_at' => Carbon::parse($news['webPublicationDate']),
                ],
                'category' => [
                    'name' => $news['sectionName'],
                ],
                'author' => null,
                'source' => [
                    'name' => 'The Guardian',
                ]
            ];
        }

        return app(NewsService::class)->save($newsData);
    }
}
