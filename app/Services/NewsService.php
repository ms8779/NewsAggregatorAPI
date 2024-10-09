<?php

namespace App\Services;

use App\Models\Author;
use App\Models\Category;
use App\Models\News;
use App\Models\Source;

class NewsService
{
    // Saving news in bulk
    public function save(array $newsData){
        $tNews = [];
        foreach ($newsData as $news) {
            $source = $author = $category = null;

            if ($news['category']) {
                $category = Category::updateOrCreate(
                    ['name' => $news['category']['name']],
                    ['name' => $news['category']['name']]
                );
            }

            if ($news['source']) {
                $source = Source::updateOrCreate(
                    ['name' => $news['source']['name']],
                    ['name' => $news['source']['name']]
                );
            }

            if ($news['author']) {
                $author = Author::updateOrCreate(
                    ['name' => $news['author']['name']],
                    ['name' => $news['author']['name']]
                );
            }

            $tNews[] = array_merge($news['article'], [
                'source_id' => $source ? $source->id : null,
                'author_id' => $author ? $author->id : null,
                'category_id' => $category ? $category->id : null
            ]);
        }

        return News::upsert($tNews, [
            'title',
            'description',
            'category_id',
            'author_id',
            'source_id',
            'published_at',
        ]);
    }

    public static function formatAuthor(?string $authors): ?string
    {
        if (is_null($authors)) return null;
        return explode(',', $authors)[0] ?? '';
    }
}
