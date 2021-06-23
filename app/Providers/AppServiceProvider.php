<?php

namespace App\Providers;

use App\Category_post;
use Illuminate\Support\ServiceProvider;
use App\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('templates.master', function ($view) {

            $category = Category_post::query()->get();
            $view->with('category', $category);

        });

        view()->composer('post.category', function ($viewCategory) {
            $category = Category_post::showCategory();
            $viewCategory->with('category', $category);
        });
    }

}
