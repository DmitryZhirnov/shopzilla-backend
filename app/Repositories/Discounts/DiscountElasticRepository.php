<?php

namespace App\Repositories\Discounts;

use App\Repositories\ElasticRepository;
use Carbon\Carbon;
use Elasticsearch\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class DiscountElasticRepository extends ElasticRepository implements DiscountRepositoryContract
{
    public function __construct(Client $client)
    {
        $this->fields = ['title^2', 'description^1', 'tags^4', 'category.title^3'];
        $this->model = new \App\Models\Discount;
        parent::__construct($client);
    }

    public function favorites(): array
    {
        $user = auth()->user();
        return Cache::remember("USER_{$user->id}_FAVORITES", Carbon::now()->addMinute(), function () use ($user) {
            try {
                $items = $this->elasticsearch->search([
                    'index' => 'favorite_' . $this->model->getSearchIndex(),
                    'type' => $this->model->getSearchType(),
                    '_source' => ['model'],
                    'body' => [
                        'query' => [
                            'match' => [
                                'user_id' => $user->id
                            ]
                        ],
                    ],
                ]);
                $items = Arr::pluck($items['hits']['hits'], '_source.model');
                return  $items;
            } catch (\Exception $ex) {
                info($ex);
                throw $ex;
            }
        });
    }
}
