<?php

return [
    'blogs' => [
        [
            'id' => 'default',
            'public_path' => 'blog',
            'entry_provider' => \Bjuppa\LaravelBlog\Eloquent\BlogEntryProvider::class,
        ]
    ],
    'eloquent_entries_table' => 'blog_entries',
];
