<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Eloquent\BlogEntry;
use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class SocialSharingTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->loadRegisteredMigrations();
        $this->seedDefaultBlogEntry();
    }

    public function test_sharing_section() {
        $response = $this->get('blog/the-first-post');

        $response->assertSee('<h2>Share this page</h2>');
        $response->assertSee('<ul title="Links for sharing this page">');
    }

    public function test_facebook_link()
    {
        $response = $this->get('blog/the-first-post');

        $response->assertSee('<li class="share-on-facebook">');
        $response->assertSee('<a href="https://www.facebook.com/sharer.php?u=http%3A%2F%2Flocalhost%2Fblog%2Fthe-first-post" target="_blank" rel="noopener">');
        $response->assertSee('><span class="share-link-prefix">Share this page on </span><span class="share-link-service">Facebook</span></a>');
    }
}
