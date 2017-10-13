<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Configuration for each blog
    |--------------------------------------------------------------------------
    |
    | List every blog you want to publish in this array of blog configurations.
    | Every blog is keyed by its blog identifier. E.g. 'tech' or 'marketing',
    | or whatever sets the blogs on your website apart.
    |
    | In each blog's config array you may put any key corresponding to the
    | with-methods of the Blog class you're using.
    |
    */

    'blogs' => [
        //TODO: rename default blog to "main"
        'default' => [
            'public_path' => 'blog',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default configuration for blogs
    |--------------------------------------------------------------------------
    |
    | If you want some configurations to apply to all your blogs, this
    | array takes the same keys as the blog configurations above.
    |
    | If a blog has a specific key set in the blogs configuration,
    | that will take precedence.
    |
    */

    'blog_defaults' => [
        //
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

    /*
    |--------------------------------------------------------------------------
    | Table name for Eloquent blog entries
    |--------------------------------------------------------------------------
    |
    | Blog entries are stored in a table called `blog_entries` by default. If
    | you want another name for the table you can set it here. This table
    | name will be used by the registered migrations and the BlogEntry
    | model (as well as its descendants, should you extend it).
    |
    */

    'eloquent_entries_table' => 'blog_entries',
];
