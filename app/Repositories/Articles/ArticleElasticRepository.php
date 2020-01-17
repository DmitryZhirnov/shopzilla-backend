<?php

namespace App\Repositories\Articles;

use App\Repositories\ElasticRepository;
use Elasticsearch\Client;

class ArticleElasticRepository extends ElasticRepository implements ArticleRepositoryContract
{
    public function __construct(Client $client)
    {
        $this->fields = ['title^2', 'body^1','tags^3'];
        $this->model = new \App\Models\Article;
        parent::__construct($client);
    }
}
