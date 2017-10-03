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
        $this->assertInstanceOf(Blog::class, $this->app->make(BlogContract::class, ['id' => 'default']));
    }

    public function test_default_blog_is_configured()
    {
        $this->assertEquals(config('blog.blogs.default.public_path'),
            $this->app->make(BlogRegistryContract::class)->get('default')->getPublicPath());
    }
}
