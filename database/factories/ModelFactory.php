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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->colorName,
    ];
});

$factory->define(App\Color::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->safeColorName,
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->realText(200,2),
        'price' => $faker->randomFloat(null,0,1000),
        'id_category' => $faker->numberBetween(1,5)
    ];
});

$factory->define(App\ProductColor::class, function (Faker\Generator $faker) {
    return [
        'id_product' => $faker->numberBetween(1,50),
        'id_color' => $faker->numberBetween(1,10)
    ];
});

$factory->define(App\Language::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->randomElement($array = array ('Ingles','Frances','Aleman'))
    ];
});
