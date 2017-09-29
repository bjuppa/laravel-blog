<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\BlogRegistry;
use Bjuppa\LaravelBlog\Contracts\BlogRegistry as BlogRegistryContract;
use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class ServiceProviderTest extends IntegrationTest
{
    public function test_blog_registry_contract_can_be_resolved()
    {
        $this->assertInstanceOf(BlogRegistry::class, $this->app->make(BlogRegistryContract::class));
    }
}
