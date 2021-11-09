<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Dao 
        $this->app->bind(
            'App\Contracts\Dao\Post\PostDaoInterface', 'App\Dao\Post\PostDao');

        //Services (Business Logic)
        $this->app->bind(
            'App\Contracts\Services\Post\PostServiceInterface', 'App\Services\Post\PostService');

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        //
        \DB::listen(function($query) {
            $sql = $query->sql;
            for($i=0;$i<count($query->bindings);$i++) {
                $sql = preg_replace("/\?/", $query->bindings[$i], $sql, 1);
            }
            \Log::info($sql);
        });
    }
}
