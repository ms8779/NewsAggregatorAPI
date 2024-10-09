<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Services\NewsService;

class NewYorkTimesService
{
    private array $queryStr;

    public function __construct()
    {
        $this->queryStr = [
            'api-key' => env('NEW_YORK_TIMES_KEY'),
            'from-date' => Carbon::yesterday()->format('Y-m-d'),
            'to-date' => Carbon::today()->format('Y-m-d'),
            'page' => 1,
            'sort' => 'newest'
        ];
    }

    public function fetchAndSave(){
        $response = Http::get(
            'http://api.nytimes.com/svc/search/v2/articlesearch.json',
            $this->queryStr
        );

        $result = $response->json();
        $tNews = $result['response']['docs'];

        $newsData = [];
        foreach ($tNews as $news) {
            $newsData[] = [
                'article' => [
                    'title' => $news['headline']['main'],
                    'description' => $news['lead_paragraph'],
                    'published_at' => Carbon::parse($news['pub_date']),
                ],
                'source' => [
                    'name' => $news['source']
                ],
                'category' => [
                    'name' => $news['section_name']
                ],
                'author' => $news['byline']['original']?
                    ['name' => substr($news['byline']['original'], 3)] : null
            ];
        }

        return app(NewsService::class)->save($newsData);
    }
}
