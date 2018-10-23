<?php

use Faker\Generator as Faker;

$factory->define(Bjuppa\LaravelBlog\Eloquent\BlogEntry::class, function (Faker $faker) {
    $faker->addProvider(new BlogArticleFaker\FakerProvider($faker));

    return [
        'title' => $faker->articleTitle,
        'content' => $faker->articleContentMarkdown,
    ];
});
