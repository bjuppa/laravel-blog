<?php

return [
    'blogs' => [
        [
            'id' => 'default',
            'public_path' => 'blog',
            'entry_provider' => \Bjuppa\LaravelBlog\Eloquent\BlogEntryProvider::class,
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Table name for Eloquent blog entries
    |--------------------------------------------------------------------------
    |
    | Blog entries are stored in a table called `blog_entries` by default. If
    | you want another name for the table you can set it here. This table
    | name will be used by the registered migrations and the BlogEntry
    | model (and its descendants should you extend it).
    |
    */

    'eloquent_entries_table' => 'blog_entries',
];
