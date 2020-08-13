<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CalendarEvent\CalendarEventInterface;
use App\Services\CalendarEvent\CalendarEventService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CalendarEventInterface::class, CalendarEventService::class);
    }
}
