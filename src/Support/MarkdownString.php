<?php

namespace Bjuppa\LaravelBlog\Support;

use Illuminate\Contracts\Support\Htmlable;

class MarkdownString implements Htmlable
{
    /**
     * @var string
     */
    protected $markdown;

    /**
     * MarkdownString constructor.
     * @param string $markdown
     */
    public function __construct(string $markdown)
    {
        $this->markdown = $markdown;
    }

    /**
     * Parse given markdown to html
     * @param $markdown
     * @return string
     */
    protected static function parse($markdown): string
    {
        if(class_exists('\GrahamCampbell\Markdown\Facades\Markdown')) {
            //TODO: check for existence of either GrahamCampbell\Markdown\Facades\Markdown or \Markdown
            // This package should suggest installing either of those two packages

            return \GrahamCampbell\Markdown\Facades\Markdown::convertToHtml($markdown);
        }

        if(class_exists('\Markdown')) {
            //TODO: parse using \Markdown
        }

        // No parser found, returning the original string
        return $markdown;
    }

    /**
     * Get content as a string of HTML.
     *
     * @return string
     */
    public function toHtml()
    {
        return self::parse($this->markdown);
    }
}
