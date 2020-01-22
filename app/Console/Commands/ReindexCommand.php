<?php

namespace App\Console\Commands;


use App\Models\Category;
use App\Models\Discount;
use Elasticsearch\Client;
use Illuminate\Console\Command;

class ReindexCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:reindex';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all searchable models to Elasticsearch';
    /** @var \Elasticsearch\Client */
    private $elasticsearch;

    /** @var array 
     * Классы моделей для добавления в поиск
     */
    private $models = [
        Category::class,
        Discount::class,
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $elasticsearch)
    {
        parent::__construct();
        $this->elasticsearch = $elasticsearch;
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->models as $model) {
            $this->info("Indexing all {$model}. This might take a while...");
            foreach ($model::cursor() as $model) {
                $this->elasticsearch->index([
                    'index' => $model->getSearchIndex(),
                    'type' => $model->getSearchType(),
                    'id' => $model->getKey(),
                    'body' => $model->toSearchArray(),
                ]);
                $this->output->write('.');
            }
        }
        $this->info('\nDone!');
    }
}
