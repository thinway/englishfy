<?php

use Faker\Generator as Faker;

$factory->define(App\Reference::class, function (Faker $faker) {
    $term = $faker->sentence;
    $slug = Str::slug($term);

    return [
        'term' => $term,
        'slug' => $slug,
        'type' => $faker->randomElement(['ID', 'PV', 'SL', 'SY'])
    ];
});
