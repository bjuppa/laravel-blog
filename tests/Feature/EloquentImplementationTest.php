<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Eloquent\BlogEntry;
use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class EloquentImplementationTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->prepareDatabase();
        $this->seedDefaultBlogEntry();
    }

    public function test_global_scope_excludes_unpublished_entries()
    {
        $entry = factory(BlogEntry::class)->create();

        $this->assertFalse($entry->isPublic());
        $this->assertCount(1, BlogEntry::all());
        $this->assertCount(0, BlogEntry::all()->reject->isPublic());
    }

    public function test_with_unpublished_scope()
    {
        $entry = factory(BlogEntry::class)->create();

        $this->assertFalse($entry->isPublic());
        $this->assertCount(2, BlogEntry::withUnpublished()->get());
    }
}
