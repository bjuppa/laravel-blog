<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Eloquent\BlogEntry;
use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class BlogEntryImageTest extends IntegrationTest
{
    protected $example_image_url = 'https://upload.wikimedia.org/wikipedia/commons/c/c4/PM5544_with_non-PAL_signals.png';

    public function setUp()
    {
        parent::setUp();
        $this->loadRegisteredMigrations();
        $this->seedDefaultBlogEntry();
    }

    protected function setEntryImage($content)
    {
        $entry = BlogEntry::first();
        $entry->image = $content;
        $entry->save();
    }

    public function test_image_url()
    {
        $this->setEntryImage($this->example_image_url);

        $response = $this->get('blog/the-first-post');

        $response->assertSee($this->example_image_url);
    }

    public function test_image_tag()
    {
        $this->setEntryImage($this->example_image_url);

        $response = $this->get('blog/the-first-post');

        $response->assertSee('src="' . $this->example_image_url . '" alt=""');
    }

    public function test_image_markdown()
    {
        $this->setEntryImage('![Alt text](' . $this->example_image_url . ' "Optional title")');

        $response = $this->get('blog/the-first-post');

        $response->assertSee('alt="Alt text"');
        $response->assertSee('title="Optional title"');
    }

    public function test_css_image_url() {
        $this->setEntryImage($this->example_image_url);

        $response = $this->get('blog');

        $response->assertSee('style="--blog-entry-image: url(' . $this->example_image_url . ')"');
    }

    public function test_css_image_markdown()
    {
        $this->setEntryImage('![Alt text]('. $this->example_image_url . ' "Optional title")');

        $response = $this->get('blog');

        $response->assertSee('style="--blog-entry-image: url(' . $this->example_image_url . ')"');
    }

    public function test_css_image_html()
    {
        $this->setEntryImage('<img alt="Alt text" src="'. $this->example_image_url . '">');

        $response = $this->get('blog');

        $response->assertSee('style="--blog-entry-image: url(' . $this->example_image_url . ')"');
    }

    public function test_image_meta_data()
    {
        $this->setEntryImage($this->example_image_url);

        $response = $this->get('blog/the-first-post');

        $response->assertDontSee('<meta name="twitter:card" content="summary">');
        $response->assertSee('<meta name="twitter:card" content="summary_large_image">');
        $response->assertSee('<meta name="twitter:image" content="'. $this->example_image_url . '">');
    }
}
