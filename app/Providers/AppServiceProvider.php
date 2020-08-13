<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Services\CalendarEvent\CalendarEventInterface;
use App\Services\CalendarEvent\CalendarEventService;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Boot Method
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('valid_month', function ($attribute, $value, $parameters, $validator) {
            return ( in_array($value, ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december']) );
        });
    }

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
