<?php

namespace Bjuppa\LaravelBlog\Tests\Unit;

use Bjuppa\LaravelBlog\Blog;
use Bjuppa\LaravelBlog\Eloquent\BlogEntryProvider;
use Bjuppa\LaravelBlog\Tests\UnitTest;

class BlogTest extends UnitTest
{
    /**
     * Make a default Blog instance with a simple config
     * @return Blog
     */
    public static function createTestBlogInstance($blog_id = 'test', $configuration = []): Blog
    {
        $default_configuration = ['entry_provider' => BlogEntryProvider::class];

        return new Blog(app(), $blog_id, array_merge($default_configuration, $configuration));
    }

    public function test_entry_provider_can_be_set_as_string()
    {
        $blog = self::createTestBlogInstance();

        $blog->withEntryProvider(BlogEntryProvider::class);
    }

    public function test_entry_provider_can_be_set_as_instance()
    {
        $blog = self::createTestBlogInstance();

        $blog->withEntryProvider(new BlogEntryProvider());
    }
}
