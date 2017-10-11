<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Tests\IntegrationTest;
use Bjuppa\LaravelBlog\Contracts\BlogRegistry as BlogRegistryContract;

class DefaultBlogTest extends IntegrationTest
{
    public function test_blog_is_configured()
    {
        $default_registered_blog = $this->app->make(BlogRegistryContract::class)->get('default');

        $this->assertEquals(config('blog.blogs.default.public_path'), $default_registered_blog->getPublicPath());
        $this->assertInstanceOf(config('blog.blogs.default.entry_provider'), $default_registered_blog->getEntryProvider());
    }

    public function test_index_page()
    {
        $response = $this->get('blog');

        $response->assertStatus(200);
    }
}
