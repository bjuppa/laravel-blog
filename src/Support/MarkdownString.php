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
        if (class_exists('\GrahamCampbell\Markdown\Facades\Markdown') and app()->has('markdown')) {
            return app()->make('markdown')->convertToHtml($markdown);
        }

        if (class_exists('\Parsedown')) {
            return \Parsedown::instance()->text($markdown);
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
