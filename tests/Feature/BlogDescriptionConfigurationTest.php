<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class BlogDescriptionConfigurationTest extends IntegrationTest
{
    protected $fakeEntryProvider = true;

    protected function extraConfigs(): array
    {
        return ['blog.blogs.main.description' => 'This is a test blog.'];
    }

    public function test_css_is_linked()
    {
        $response = $this->get('blog');

        $response->assertSee('This is a test blog');
    }

}
