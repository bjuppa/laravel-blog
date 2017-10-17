<?php

namespace Bjuppa\LaravelBlog\Support;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class MarkdownParser
{
    //TODO: check for existence of either GrahamCampbell\Markdown\Facades\Markdown or \Markdown
    // This package should suggest installing either of those two packages
    public static function parse(string $markdown): string
    {
        return \GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($markdown);
    }

    public static function parseToHtmlable(string $markdown): Htmlable
    {
        return new HtmlString(self::parse($markdown));
    }
}
