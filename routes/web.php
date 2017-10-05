<?php

use Bjuppa\LaravelBlog\Contracts\Blog;
use Bjuppa\LaravelBlog\Contracts\BlogRegistry;

Route::middleware('web')->group(function () {
    $blog_registry = app()->make(BlogRegistry::class);
    $blog_registry->all()->each(function (Blog $blog) {
        // TODO: publish named routes to each blog's index and entries
    });
});


