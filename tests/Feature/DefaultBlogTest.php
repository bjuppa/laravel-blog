<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class DefaultBlogTest extends IntegrationTest
{
    public function test_index_page()
    {
        $response = $this->get('blog');

        $response->assertStatus(200);
    }
}
