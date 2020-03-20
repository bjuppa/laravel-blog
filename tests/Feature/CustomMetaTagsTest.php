<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class CustomMetaTagsTest extends IntegrationTest
{
    public function setUp(): void
    {
        parent::setUp();
        $this->loadRegisteredMigrations();
        $this->seedDefaultBlogEntry();
    }

    protected function extraConfigs(): array
    {
        return ['blog.blogs.main.index_meta_tags' => [
            ['property' => 'og:title', 'content' => 'Custom opengraph title'],
        ]];
    }

    public function test_custom_meta_tags_on_blog()
    {
        $response = $this->get('blog');

        $response->assertSee('<meta property="og:title" content="Custom opengraph title">', false);
        $response->assertDontSee('<meta property="og:title" content="Main Blog">', false);
    }
}
