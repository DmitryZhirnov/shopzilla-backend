<?php

namespace App\Repositories\Articles;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

class ArticleEloquentRepository implements ArticleRepositoryContract
{
    public function search(string $query = ''): Collection
    {
        if (empty($query))
            return Article::all();
        return Article::where('body', 'LIKE', "%{$query}%")
            ->orWhere('title', 'LIKE', "%{$query}%")
            ->get();
    }
}
