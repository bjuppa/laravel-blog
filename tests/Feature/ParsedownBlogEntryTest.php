<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Eloquent\BlogEntry;
use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class ParsedownBlogEntryTest extends IntegrationTest
{
    /**
     * By not loading the GrahamCampbell\Markdown service provider we should fallback to use the Parsedown parser
     */

    public function test_body_markdown_is_parsed()
    {
        $entry = new BlogEntry();
        $entry->content = "# The Headline\n\nA *paragraph*";

        $html_string = $entry->getContent()->toHtml();

        $this->assertContains('<h1>The Headline</h1>', $html_string);
        $this->assertContains('<p>A <em>paragraph</em></p>', $html_string);
    }

    public function test_image_markdown_is_parsed()
    {
        $entry = new BlogEntry();
        $entry->image = '![Alt text](/path/to/img.jpg "Optional title")';

        $html_string = $entry->getImage()->toHtml();

        $this->assertContains('alt="Alt text"', $html_string);
        $this->assertContains('title="Optional title"', $html_string);
        $this->assertNotContains('<p>', $html_string);
    }
}
