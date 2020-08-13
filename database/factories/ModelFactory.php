<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use Faker\Generator as Faker;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Event::class, function (Faker $faker) {
    
    $date = Carbon::now();
    
    return [
        'uuid' => $faker->uuid,
        'event_name' => $faker->name,
        'from' => $date->format('Y-m-d'),
        'to' => $date->addDays(7)->format('Y-m-d'),
        'specific_days' => '["monday","tuesday","wednesday","thursday","friday","saturday","sunday"]',
        'color' => $faker->hexColor
    ];
});
