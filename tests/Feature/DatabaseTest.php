<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class DatabaseTest extends IntegrationTest
{
    public function setUp(): void
    {
        parent::setUp();
        $this->loadRegisteredMigrations();
        $this->seedDefaultBlogEntry();
    }

    public function test_default_entry_is_seeded()
    {
        $entry = \Bjuppa\LaravelBlog\Eloquent\BlogEntry::first();

        $this->assertEquals('main', $entry->blog);
    }

}
