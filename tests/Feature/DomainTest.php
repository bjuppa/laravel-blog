<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class DomainTest extends IntegrationTest
{
    protected $fakeEntryProvider = true;

    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
    }

    protected function extraConfigs(): array
    {
        return ['blog.blogs.main.domain' => 'sub.domain.top'];
    }

    public function test_get_without_domain()
    {
        $response = $this->get('blog');

        $response->assertStatus(404);
    }

    public function test_get_with_domain()
    {
        $response = $this->get('http://sub.domain.top/blog');

        $response->assertStatus(200);
    }

}
