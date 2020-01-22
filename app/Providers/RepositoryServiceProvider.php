<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class RepositoryServiceProvider extends ServiceProvider
{
    private $providerBindings = [
      [
            'contract' => \App\Repositories\Discounts\DiscountRepositoryContract::class,
            'eloquent' => \App\Repositories\Discounts\DiscountEloquentRepository::class,
            'elasticsearch' => \App\Repositories\Discounts\DiscountElasticRepository::class
        ],
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->providerBindings as $binding) {
            $this->app->bind($binding['contract'], function () use ($binding) {
                // Это полезно, если мы хотим выключить наш кластер
                // или при развертывании поиска на продакшене
                if (!config('services.search.enabled')) {
                    return new $binding['eloquent']();
                }
                return new $binding['elasticsearch']($this->app->make(Client::class));
            });
        }

        $this->bindSearchClient();
    }
    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.hosts'))
                ->build();
        });
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
