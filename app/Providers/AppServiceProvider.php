<?php

namespace App\Providers;

use App\Models\Activity;
use App\Observers\ActivityObserver;
use Filament\Tables\Columns\TextColumn;
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
        TextColumn::macro('formatAsDateTime', function () {
            return $this->dateTime('Y-m-d H:i:s');
        });
        //活动观察器
        Activity::observe(ActivityObserver::class);
    }
}
