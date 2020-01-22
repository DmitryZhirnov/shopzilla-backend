<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Discount;
use Carbon\Carbon;
use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(Discount::class, function (Faker $faker) {
    
    $categoryId = Category::all()->pluck("id")->random(1)->values()->all()[0];

    $minDate = Carbon::now()->addDays(-30);
    $maxDate = Carbon::now()->addDays(30);
    $now = Carbon::now();

    $tags = collect(['колбаса', 'джинсы', 'коньяк', 'fairy'])
        ->random(2)
        ->values()
        ->all();

    $faker = Factory::create('ru_RU');

    return [
        'title' => $faker->realText(50),
        'description' => $faker->realText(500),
        'category_id' => $categoryId,
        'discount' => $faker->numberBetween(0, 100),
        'date_from' => $faker->dateTimeBetween($minDate, $now),
        'date_to' => $faker->date($now, $maxDate),
        'image_url' => $faker->imageUrl(300,200),
        'edit_user_id' => 2,
        'tags' => $tags,
    ];
});
