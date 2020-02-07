<?php

namespace Bjuppa\LaravelBlog\Contracts;

use Illuminate\Contracts\Support\Htmlable;

/**
 * Implementations of MarkdownString should hold a markdown string
 * and return the parsed markdown as HTML when toHtml() is called.
 */
interface MarkdownString extends Htmlable
{
    /**
     * Create a new instance of MarkdownString
     * @param string $markdown
     */
    public static function create(string $markdown): MarkdownString;
}
