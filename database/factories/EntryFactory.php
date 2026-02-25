<?php

use Faker\Generator as Faker;

$factory->define(Bjuppa\LaravelBlog\Eloquent\BlogEntry::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraphs(3, true),
    ];
});
