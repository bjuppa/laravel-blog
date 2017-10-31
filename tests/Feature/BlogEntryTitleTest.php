<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Eloquent\BlogEntry;
use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class BlogEntryTitleTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->loadRegisteredMigrations();
        $this->seedDefaultBlogEntry();
    }

    public function test_title()
    {
        $entry = BlogEntry::first();
        $entry->page_title = 'Page title';
        $entry->save();

        $response = $this->get('blog/the-first-post');

        $response->assertSee('<title>Page title</title>');
    }
}
