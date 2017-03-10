<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Carbon\Carbon;
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Vuser::class, function (Faker\Generator $faker) {

    return [
        'vcat_id' => 4,
        'province_id' => 2,
        'name' => $faker->userName,
        'post_id' => 1,
        'mobile' => '1' . $faker->shuffle('1234567890'),
        'code' => $faker->shuffle('12345678'),
        'card' => $faker->shuffle('12345678'),
        'company' => $faker->company,
        'salesman_id' => 1,
        'regional_manager_id' => 1,
        'hotel' => $faker->company,
        'is_sign' => $faker->boolean?1:0,
        'created_at'           => Carbon::now()->toDateTimeString(),
        'updated_at'           => Carbon::now()->toDateTimeString(),
    ];
});

$factory->define(App\Salesman::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->userName,
        'created_at'           => Carbon::now()->toDateTimeString(),
        'updated_at'           => Carbon::now()->toDateTimeString(),
    ];
});

$factory->define(App\Manager::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->userName,
        'created_at'           => Carbon::now()->toDateTimeString(),
        'updated_at'           => Carbon::now()->toDateTimeString(),
    ];
});

$factory->define(App\Conference::class, function (Faker\Generator $faker) {
    $sign_vcat_count = $faker->numberBetween(0,1000);
    return [
        'date' =>  Carbon::now()->toDateString(),
        'start_time'           => Carbon::now()->toTimeString(),
        'end_time'           => Carbon::now()->toTimeString(),
        'name'           => $faker->userName,
        'description'           => $faker->userName,
        'sign_count'           => $faker->numberBetween($sign_vcat_count,1000),
        'created_at'           => Carbon::now()->toDateTimeString(),
        'updated_at'           => Carbon::now()->toDateTimeString(),
    ];
});


$factory->define(App\SignLog::class, function (Faker\Generator $faker) {

    $conference_ids_array = \App\Conference::pluck('id') ->flatten(1)->all();
    return [
        'vuser_id' => $faker->numberBetween(0,60),
        'admin_user_name' => $faker->userName,
        'conference_id' => $conference_ids_array[array_rand($conference_ids_array,1)],
        'conference_name' => $faker->userName,
        'created_at'           => Carbon::now()->toDateTimeString(),
        'updated_at'           => Carbon::now()->toDateTimeString(),
    ];
});


$factory->define(App\Hotel::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->userName,
        'created_at'           => Carbon::now()->toDateTimeString(),
        'updated_at'           => Carbon::now()->toDateTimeString(),
    ];
});