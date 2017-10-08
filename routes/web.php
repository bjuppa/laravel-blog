<?php

use Bjuppa\LaravelBlog\Contracts\Blog;
use Bjuppa\LaravelBlog\Contracts\BlogRegistry;

Route::middleware('web')->namespace('Bjuppa\LaravelBlog\Http\Controllers')->group(function () {
    $blog_registry = app()->make(BlogRegistry::class);
    $blog_registry->all()->each(function (Blog $blog) {
        Route::prefix($blog->getPublicPath())->group(function () {
            Route::get('/', 'ListEntriesController@showIndex');
            Route::get('{slug}', 'ShowEntryController');
        });
    });
});


