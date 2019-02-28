<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Eloquent\BlogEntry;
use Bjuppa\LaravelBlog\Tests\IntegrationTest;
use Carbon\Carbon;

class EloquentImplementationTest extends IntegrationTest
{
    public function setUp(): void
    {
        parent::setUp();
        $this->prepareDatabase();
        $this->seedDefaultBlogEntry();
    }

    public function test_global_scope_excludes_unpublished_entries()
    {
        $entry = factory(BlogEntry::class)->create();
        $this->assertFalse($entry->isPublic());

        $this->assertCount(count(BlogEntry::all()) - 1, BlogEntry::all()->reject->isPublic());
    }

    public function test_with_unpublished_scope()
    {
        $entry = factory(BlogEntry::class)->create();
        $this->assertFalse($entry->isPublic());

        $this->assertCount(count(BlogEntry::all()) + 1, BlogEntry::withUnpublished()->get());
    }

    public function test_scheduled_scopes()
    {
        $scheduledEntry = factory(BlogEntry::class)->create([BlogEntry::PUBLISH_AFTER => Carbon::now()->addHour()]);
        $this->assertFalse($scheduledEntry->isPublic());

        $draftEntry = factory(BlogEntry::class)->create();
        $this->assertFalse($draftEntry->isPublic());

        $this->assertCount(1, BlogEntry::onlyScheduled()->get());
        $this->assertCount(1, BlogEntry::onlyDrafts()->get());
        $this->assertCount(2, BlogEntry::onlyUnpublished()->get());
    }
}
