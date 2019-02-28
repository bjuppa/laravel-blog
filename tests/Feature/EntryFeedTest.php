<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Eloquent\BlogEntry;
use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class EntryFeedTest extends IntegrationTest
{
    public function setUp(): void
    {
        parent::setUp();
        $this->loadRegisteredMigrations();
        $this->seedDefaultBlogEntry();
    }

    public function test_feed_hides_full_content()
    {
        $response = $this->get('blog/feed');

        $response->assertDontSee('<content');
    }

    public function test_entry_can_hide_full_content()
    {
        $entry = BlogEntry::first();
        $entry->display_full_content_in_feed = true;
        $entry->save();

        $response = $this->get('blog/feed');

        $response->assertSee('<content');
    }
}
