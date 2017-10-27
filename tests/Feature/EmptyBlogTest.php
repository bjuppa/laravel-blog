<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class EmptyBlogTest extends IntegrationTest
{
    protected $fakeEntryProvider = true;

    public function test_index_page()
    {
        $response = $this->get('blog');

        $response->assertStatus(200);
    }

}
