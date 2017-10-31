<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Configuration for each blog
    |--------------------------------------------------------------------------
    |
    | List every blog you want to publish in this array of blog configurations.
    | Each blog is keyed by its blog identifier. E.g. 'tech' or 'marketing',
    | or whatever sets the blogs on your website apart.
    |
    | In each blog's config array you may put any key corresponding to the
    | with-methods of the Blog class you're using.
    |
    */

    'blogs' => [
        // This configures one blog
        'main' => [
            'public_path' => 'blog',
            'title' => 'Main Blog',
            //'description' => '',
        ],
        // You can add more blogs here...
    ],

    /*
    |--------------------------------------------------------------------------
    | Default configuration for blogs
    |--------------------------------------------------------------------------
    |
    | If you want some configurations to apply to all your blogs, this
    | array takes the same keys as the blog configurations above.
    |
    | If a blog has a specific key set in the 'blogs' configuration,
    | that will take precedence.
    |
    */

    'blog_defaults' => [
        'stylesheets' => ['css/app.css'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Prefix for named routes
    |--------------------------------------------------------------------------
    |
    | Every blog is given named routes and the prefix for those names can be
    | changed by this config.
    |
    */

    'route_name_prefix' => 'blog',
];
