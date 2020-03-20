<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Eloquent\BlogEntry;
use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class BlogFeedConfigurationTest extends IntegrationTest
{
    public function setUp(): void
    {
        parent::setUp();
        $this->loadRegisteredMigrations();
        $this->seedDefaultBlogEntry();
    }

    protected function extraConfigs(): array
    {
        return ['blog.blogs.main.full_entries_in_feed' => true];
    }

    public function test_feed_has_full_content()
    {
        $response = $this->get('blog/feed');

        $response->assertSee('<content', false);
    }

    public function test_entry_can_hide_full_content()
    {
        $entry = BlogEntry::first();
        $entry->display_full_content_in_feed = false;
        $entry->save();

        $response = $this->get('blog/feed');

        $response->assertDontSee('<content', false);
    }
}
