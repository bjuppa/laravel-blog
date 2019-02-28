<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class BlogAuthorConfigurationTest extends IntegrationTest
{
    public function setUp(): void
    {
        parent::setUp();
        $this->loadRegisteredMigrations();
        $this->seedDefaultBlogEntry();
    }

    protected function extraConfigs(): array
    {
        return ['blog.blogs.main.author' => ['A Name', 'an@email.com']];
    }

    public function test_entry_has_default_author()
    {
        $response = $this->get('blog/the-first-post');

        $response->assertSee('A Name');
        $response->assertSee('mailto:an@email.com');
    }

}
