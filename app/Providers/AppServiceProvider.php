<?php

namespace App\Providers;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use App\Models\Posts\PostsRepository;
use Illuminate\Support\ServiceProvider;
use App\Models\Articles\ArticlesRepository;
use App\Models\Posts\EloquentRepository as EloquentPosts;
use App\Models\Posts\ElasticsearchRepository as ElasticPosts;
use App\Models\Articles\EloquentRepository as EloquentArticles;
use App\Models\Articles\ElasticsearchRepository as ElasticArticles;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(ArticlesRepository::class, function ($app) {
            return config('services.search.enabled') ? new ElasticArticles(
                $app->make(Client::class)
            ) : new EloquentArticles();
        });

        $this->app->bind(PostsRepository::class, function ($app) {
            return config('services.search.enabled') ? new ElasticPosts(
                $app->make(Client::class)
            ) : new EloquentPosts();
        });

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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
