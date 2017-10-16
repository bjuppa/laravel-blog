<?php

use Bjuppa\LaravelBlog\Contracts\Blog;
use Facades\Bjuppa\LaravelBlog\Contracts\BlogRegistry;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web'], 'namespace' => 'Bjuppa\LaravelBlog\Http\Controllers'], function () {
    BlogRegistry::all()->each(function (Blog $blog) {
        $group_attributes = array_filter([
            'domain' => $blog->getDomain(),
            'prefix' => $blog->getPublicPath()
        ]);
        Route::group($group_attributes, function () use ($blog) {
            Route::get('/', 'ListEntriesController@showIndex')->name($blog->prefixRouteName('index'));
            Route::get('{slug}', 'ShowEntryController')->name($blog->prefixRouteName('entry'));
        });
    });
});
