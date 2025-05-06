<?php

namespace App\Providers;

use App\Models\Activity;
use App\Observers\ActivityObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //活动观察器
        Activity::observe(ActivityObserver::class);
    }
}
