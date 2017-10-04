<?php

namespace Bjuppa\LaravelBlog\Tests\Unit;

use Bjuppa\LaravelBlog\Blog;
use Bjuppa\LaravelBlog\Eloquent\BlogEntryProvider;
use Bjuppa\LaravelBlog\Tests\UnitTest;

class BlogTest extends UnitTest
{
    public function test_entry_provider_can_be_set_as_string()
    {
        $blog = new Blog(new BlogEntryProvider(), 'test');

        $blog->withEntryProvider(BlogEntryProvider::class);
    }

    public function test_entry_provider_can_be_set_as_instance()
    {
        $blog = new Blog(new BlogEntryProvider(), 'test');

        $blog->withEntryProvider(new BlogEntryProvider());
    }
}
