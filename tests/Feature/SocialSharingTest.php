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

    public function test_facebook_link()
    {
        $response = $this->get('blog/the-first-post');

        $response->assertSee('<li class="share-on-facebook">');
    }
}
