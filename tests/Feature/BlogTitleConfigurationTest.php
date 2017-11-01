<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class BlogTitleConfigurationTest extends IntegrationTest
{
    protected $fakeEntryProvider = true;

    protected function extraConfigs(): array
    {
        return ['blog.blogs.main.page-title' => 'A test title'];
    }

    public function test_page_has_title()
    {
        $response = $this->get('blog');

        $response->assertSee('<title>A test title</title>');
        $response->assertSee('>Main Blog</h1>');
    }

}
