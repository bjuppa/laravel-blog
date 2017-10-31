<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Eloquent\BlogEntry;
use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class BlogEntryDescriptionTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->loadRegisteredMigrations();
        $this->seedDefaultBlogEntry();
    }

    public function test_description()
    {
        $entry = BlogEntry::first();
        $entry->description = 'This is a description.';
        $entry->save();

        $response = $this->get('blog/the-first-post');

        $response->assertSee('<meta name="description" content="This is a description.">');
    }
}
