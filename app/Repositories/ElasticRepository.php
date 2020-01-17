<?php

namespace App\Repositories;


use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class ElasticRepository implements SearchContract
{
    /** @var \Elasticsearch\Client */
    protected $elasticsearch;
    /** @var \Illuminate\Database\Eloquent\Model */
    protected $model;
    /** @var \array */
    protected $fields = [];

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }
    public function search(string $query = '', int $from = 0, int $size = 16): Array
    {
        $items = $this->searchOnElasticsearch($query, $from, $size);
        return [
            'items' => $this->buildCollection($items),
            'from' => $from,
            'size' => $size
        ];
    }
    protected function searchOnElasticsearch(string $query = '', int $from, int $size): array
    {
        if (empty($query))
            return $this->elasticsearch->search([
                'index' => $this->model->getSearchIndex(),
                'type' => $this->model->getSearchType(),
                'size' => $size,
                'from' => $from,
            ]);

        $items = $this->elasticsearch->search([
            'index' => $this->model->getSearchIndex(),
            'type' => $this->model->getSearchType(),
            'from' => $from,
            'size' => $size,
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => $this->fields,
                        'query' => $query,
                        "fuzziness" => "auto",
                        "operator" => "and"
                    ],
                ],
            ],
        ]);
        return $items;
    }
    private function buildCollection(array $items): Collection
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');

        return $this->model::findMany($ids)
            ->sortBy(function ($model) use ($ids) {
                return array_search($model->getKey(), $ids);
            });
    }
}
