<?php

namespace Bjuppa\LaravelBlog\Database\Seeds;

use Illuminate\Database\Seeder;

class DefaultBlogEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Bjuppa\LaravelBlog\Eloquent\BlogEntry::create(['title' => 'The first post', 'content' => 'This is the main content of the first post']);
    }
}
