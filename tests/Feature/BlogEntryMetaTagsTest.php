<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Eloquent\BlogEntry;
use Bjuppa\LaravelBlog\Tests\IntegrationTest;
use Bjuppa\MetaTagBag\MetaTagBag;

class BlogEntryMetaTagsTest extends IntegrationTest
{
    public function setUp(): void
    {
        parent::setUp();
        $this->loadRegisteredMigrations();
        $this->seedDefaultBlogEntry();
    }

    protected function setEntryMetaTags($meta_tags)
    {
        $entry = BlogEntry::first();
        $entry->meta_tags = $meta_tags;
        $entry->save();
    }

    public function test_null_meta_tags()
    {
        $entry = BlogEntry::first();
        $originalTagBag = $entry->getMetaTagBag();

        $this->setEntryMetaTags(null);

        $this->assertEquals($originalTagBag, $entry->getMetaTagBag());
    }

    public function test_json_meta_tags()
    {
        $this->setEntryMetaTags('[{"a": "b"}]');

        $response = $this->get('blog/the-first-post');

        $response->assertSee('<meta a="b">');
    }

    public function test_invalidjson_meta_tags()
    {
        $this->setEntryMetaTags('[{"a": "b"},]');

        $response = $this->get('blog/the-first-post');

        $response->assertDontSee('<meta a="b">');
    }

    public function test_array_meta_tags()
    {
        $this->setEntryMetaTags(['a' => 'b']);

        $response = $this->get('blog/the-first-post');

        $response->assertSee('<meta a="b">');
    }

    public function test_bag_meta_tags()
    {
        $this->setEntryMetaTags(new MetaTagBag(['a' => 'b']));

        $response = $this->get('blog/the-first-post');

        $response->assertSee('<meta a="b">');
    }
}
