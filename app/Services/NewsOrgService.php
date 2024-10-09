<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class NewsOrgService
{
    private array $queryStr;

    public function __construct()
    {
        $this->queryStr = [
            'apiKey' => trim(env('NEWS_ORG_KEY')),
            'q' => 'a',
            'from_date' => Carbon::yesterday()->format('Y-m-d'),
            'to_date' => Carbon::today()->format('y-m-d'),
            'page' => 1
        ];
    }

    public function fetchAndSave(){
        $result = Http::get(
            'http://newsapi.org/v2/top-headlines',
            $this->queryStr
        );

        $tNews = $result->json('articles');

        $newsData = [];
        foreach ($tNews as $news) {
            if ($news['title'] !== '[Removed]') {
                $newsData[] = [
                    'article' => [
                        'title' => $news['title'],
                        'description' => $news['description'],
                        'published_at' => Carbon::parse($news['publishedAt']),
                        'image_url' => $news['urlToImage'],
                    ],
                    'source' => [
                        'name' => $news['source']['name']
                    ],
                    'author' => $news['author'] ? [
                        'name' => NewsService::formatAuthor($news['author'])
                    ] : null,
                    'category' => null
                ];
            }
        }

        return app(NewsService::class)->save($newsData);
    }


}
