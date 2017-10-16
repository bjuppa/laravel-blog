<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Tests\Feature\Fakes\TestMiddleware;
use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class BlogMiddlewareConfigurationTest extends IntegrationTest
{
    protected $fakeEntryProvider = true;

    protected function extraConfigs(): array
    {
        return ['blog.blogs.main.middleware' => TestMiddleware::class];
    }

    public function test_middleware_runs()
    {
        $response = $this->get('blog');

        $response->assertHeader('X-Test-Middleware', 'OK');
    }
}
