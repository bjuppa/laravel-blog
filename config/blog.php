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
        // This configures one blog with id `main`
        'main' => [
            'public_path' => 'blog',
            'title' => 'Main Blog',
            'author' => [
                'name' => 'Author name',
                //'email' => 'author@email.com',
                //'url' => 'http://author-website.com/about',
            ],
            //'page-title' => "Your title for the blog's index page",
            //'entry-page-title-suffix' => ' - Main Blog',
            'index_meta_tags' => [
                //['name' => 'description', 'content' => "Meta-description for blog index page (~160 characters)"],
                //['property' => 'og:title', 'content' => 'Custom opengraph title'],
            ],
            'default_meta_tags' => [
                //['property' => 'fb:app_id', 'content' => 'FACEBOOK APP ID SPECIFIC TO THIS BLOG'],
            ],
            //'domain' => 'blog.website.com',
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
        /*
         * If cast to string, stylesheets may be run through mix() here in the
         * config: (string) mix('css/app.css')
         */
        'stylesheets' => ['css/app.css'],
        //'timezone' => 'UTC', // For best results, use a named timezone like 'Europe/Stockholm'
        //'full_entries_in_feed' => false,
        //'latest_entries_limit' => 5,
        //'middleware' => [],

        /*
         * Example using a Laravel Gate
         * https://laravel.com/docs/authorization#gates
         */
        //'main_ability' => 'manage blogs',
        //'create_ability' => 'create blog entry',
        /*
         * Example using a Laravel Policy for model Bjuppa\LaravelBlog\Eloquent\BlogEntry
         * https://laravel.com/docs/authorization#creating-policies
         */
        //'edit_ability' => 'edit',
        //'preview_ability' => 'preview',
    ],

    /*
    |--------------------------------------------------------------------------
    | Meta tags for all blog pages
    |--------------------------------------------------------------------------
    |
    | If you want some meta tags to appear by default on every public blog page
    | they can be added here.
    |
     */

    'default_meta_tags' => [
        [
            'http-equiv' => 'X-UA-Compatible',
            'content' => 'IE=edge'
        ],
        [
            'name' => 'viewport',
            'content' => 'width=device-width, initial-scale=1'
        ],
        //['property' => 'fb:app_id', 'content' => env('FACEBOOK_APP_ID')],
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
