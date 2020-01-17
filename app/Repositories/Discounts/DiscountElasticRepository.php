<?php

namespace App\Repositories\Discounts;

use App\Repositories\ElasticRepository;
use Elasticsearch\Client;
use Illuminate\Support\Arr;

class DiscountElasticRepository extends ElasticRepository implements DiscountRepositoryContract
{
    public function __construct(Client $client)
    {
        $this->fields = ['title^2', 'description^1', 'tags^4', 'category^3'];
        $this->model = new \App\Models\Discount;
        parent::__construct($client);
    }

    public function favorites(): array
    {
        try {
            $items = $this->elasticsearch->search([
                'index' => 'favorite_' . $this->model->getSearchIndex(),
                'type' => $this->model->getSearchType(),
                '_source' => ['model'],
                'body' => [
                    'query' => [
                        'match' => [
                            'user_id' => auth()->user()->id
                        ]
                    ],
                ],
            ]);

            return  Arr::pluck($items['hits']['hits'], '_source.model');
        } catch (\Exception $ex) {
            info($ex);
        }
        return [];
    }
}
