<?php

return [
    'blogs' => [
        'default' => [
            'public_path' => 'blog',
        ],
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
