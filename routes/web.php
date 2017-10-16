<?php

use Bjuppa\LaravelBlog\Contracts\Blog;
use Bjuppa\LaravelBlog\Contracts\BlogRegistry;

Route::middleware('web')->namespace('Bjuppa\LaravelBlog\Http\Controllers')->group(function () {
    //TODO: pull the blog registry from a real-time facade instead of app()
    $blog_registry = app()->make(BlogRegistry::class);
    $blog_registry->all()->each(function (Blog $blog) {
        $group = array_filter([
            'domain' => $blog->getDomain(),
            'prefix' => $blog->getPublicPath()
        ]);
        Route::group($group, function () use ($blog) {
            Route::get('/', 'ListEntriesController@showIndex')->name($blog->prefixRouteName('index'));
            Route::get('{slug}', 'ShowEntryController')->name($blog->prefixRouteName('entry'));
        });
    });
});
