<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Eloquent\BlogEntry;
use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class NextPreviousEntry extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->loadRegisteredMigrations();
        $this->seedDefaultBlogEntry();
    }

    public function test_three_entries()
    {
        $entry1 = BlogEntry::first();
        $entry2 = $entry1->replicate();
        $entry2->title = "The second post";
        $entry2->slug = "the-second-post";
        $entry2->content = "Content";
        $entry2->save();
        $entry3 = $entry2->replicate();
        $entry3->title = "The third post";
        $entry3->slug = "the-third-post";
        $entry3->save();

        $response1 = $this->get('blog/the-first-post');
        $response1->assertOk();
        $response1->assertDontSee('rel="prev"');
        $response1->assertSee($entry2->slug . '" rel="next"');

        $response2 = $this->get('blog/the-second-post');
        $response2->assertOk();
        $response2->assertSee($entry1->slug . '" rel="prev"');
        $response2->assertSee($entry3->slug . '" rel="next"');

        $response3 = $this->get('blog/the-third-post');
        $response3->assertOk();
        $response3->assertSee($entry2->slug . '" rel="prev"');
        $response3->assertDontSee('rel="next"');
    }
}
