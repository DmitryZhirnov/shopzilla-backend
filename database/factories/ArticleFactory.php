<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Article;
use Faker\Factory;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    $tags = collect(['php', 'ruby', 'java', 'javascript', 'bash'])
        ->random(2)
        ->values()
        ->all();


    $faker = Factory::create('ru_RU');

    return [
        'title' => $faker->realText(50),
        'body' => $faker->realText(500),
        'tags' => $tags,
    ];
});
