<?php

namespace App\Observers;

use App\Http\Resources\DiscountResource;
use App\Models\FavoritableBase;
use Elasticsearch\Client;
use Illuminate\Support\Facades\Cache;

class ElasticsearchObserver
{
    /** @var \Elasticsearch\Client */
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function saved($model)
    {
        $this->elasticsearch->index([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey(),
            'body' => $model->toSearchArray(),
        ]);
    }
    public function deleted($model)
    {
        $this->elasticsearch->delete([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey(),
        ]);
    }

    public function favorited($model)
    {
        $index = [
            'index' => 'favorite_' . $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey(),
            'body' => [
                'user_id' => auth()->user()->id,
                'model' => $model->toSearchArray() + ['isFavorite' => true]
            ],
        ];
        $this->elasticsearch->index($index);
        $this->flush(auth()->user()->id);
    }

    public function unFavorited($model)
    {
        $this->elasticsearch->delete([
            'index' => 'favorite_' . $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey(),
        ]);
        $this->flush(auth()->user()->id);
    }
    /**
     * Очистка кеша
     */
    private function flush(int $userId)
    {
        Cache::flush("USER_{$userId}_FAVORITES");
    }
}
