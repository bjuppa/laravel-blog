<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Blog;
use Bjuppa\LaravelBlog\BlogRegistry;
use Bjuppa\LaravelBlog\Contracts\Blog as BlogContract;
use Bjuppa\LaravelBlog\Contracts\BlogRegistry as BlogRegistryContract;
use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class ServiceProviderTest extends IntegrationTest
{
    public function test_blog_registry_contract_can_be_resolved()
    {
        $this->assertInstanceOf(BlogRegistry::class, $this->app->make(BlogRegistryContract::class));
    }

    public function test_blog_contract_can_be_resolved()
    {
        $this->assertInstanceOf(Blog::class, $this->app->make(BlogContract::class, ['blog_id' => 'default']));
    }

    public function test_default_blog_is_configured()
    {
        $default_registered_blog = $this->app->make(BlogRegistryContract::class)->get('default');

        $this->assertEquals(config('blog.blogs.default.public_path'), $default_registered_blog->getPublicPath());
        $this->assertInstanceOf(config('blog.blogs.default.entry_provider'), $default_registered_blog->getEntryProvider());
    }
}
