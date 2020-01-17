<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $tags = collect(["продукты", "одежда", "алкоголь", "бытовая химия"])
        ->random(2)
        ->values()
        ->all();

    $faker = Factory::create('ru_RU');

    return [
        'title' => $faker->realText(20),
        'description' => $faker->realText(500),
        'parent_id' => null,
        'discount' => $faker->numberBetween(0, 100),
        'image_url' => $faker->imageUrl(300,200),
        'edit_user_id' => 2,
        'tags' => $tags,
    ];
});
