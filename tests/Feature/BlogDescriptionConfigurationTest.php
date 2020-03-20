<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class BlogDescriptionConfigurationTest extends IntegrationTest
{
    protected $fakeEntryProvider = true;

    protected function extraConfigs(): array
    {
        return ['blog.blogs.main.index_meta_tags' => [['name' => 'description', 'content' => 'This is a test blog.']]];
    }

    public function test_index_page_has_meta_description()
    {
        $response = $this->get('blog');

        $response->assertSee('<meta name="description" content="This is a test blog.">', false);
    }
}
