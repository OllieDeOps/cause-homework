<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    $json = '[{"first_name":"ladee","last_name":"linter","age":99,"email":"lindaladee@causelabs.com","secret":"asdfasdf","name":"ladee linter"},{"first_name":"cody","last_name":"duder","age":38,"email":"codyduder@causelabs.com","secret":"asdflj","name":"cody duder"}]';
    $emails = '["codyduder@causelabs.com","lindaladee@causelabs.com"]';
    return [
        'data' => $json,
        'emails' => $emails
    ];
});
