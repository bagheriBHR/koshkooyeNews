<?php

namespace App\Providers;

use App\Article;
use App\Category;
use App\Commercial;
use App\Setting;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        $setting = Setting::first();
        $parentCategories = Category::with(['childrenRecursive'])->where('parent_id',null)->get();
        $mostVisited = Article::where('publish_status',1)->orderBy('view_count','desc')->limit(30)->get();
        $latest = Article::where('publish_status',1)->orderBy('created_at','desc')->limit(30)->get();
        $photoArticleCount = Article::where('type',1)->where('publish_status',1)->count();
        $videoArticleCount = Article::where('type',2)->where('publish_status',1)->count();
        $soundArticleCount = Article::where('type',3)->where('publish_status',1)->count();
        View::share('parentCategories', $parentCategories);
        View::share('setting', $setting);
        View::share('mostVisited', $mostVisited);
        View::share('latest', $latest);
        View::share('photoArticleCount', $photoArticleCount);
        View::share('videoArticleCount', $videoArticleCount);
        View::share('soundArticleCount', $soundArticleCount);
    }
}
