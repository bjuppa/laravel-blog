<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Tests\Feature\Fakes\BlogEntryProvider as FakeBlogEntryProvider;
use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class DomainTest extends IntegrationTest
{
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
        $app->bind(\Bjuppa\LaravelBlog\Contracts\BlogEntryProvider::class, FakeBlogEntryProvider::class);
        $app['config']->set('blog.blogs.main.domain', 'sub.domain.top');
    }


    public function test_without_domain()
    {
        $response = $this->get('blog');

        $response->assertStatus(404);
    }

    public function test_with_domain()
    {
        $response = $this->get('http://sub.domain.top/blog');

        $response->assertStatus(200);
    }

}
