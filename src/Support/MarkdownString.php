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
     * @var bool
     */
    protected $parse_as_line;

    /**
     * MarkdownString constructor.
     * @param string $markdown
     * @param bool $parse_as_line Set to true to avoid wrapping string in paragraph.
     */
    public function __construct(string $markdown, $parse_as_line = false)
    {
        $this->markdown = $markdown;
        $this->parse_as_line = (bool)$parse_as_line;
    }

    /**
     * Parse given markdown to html
     * @param $markdown
     * @param bool $parse_as_line
     * @return string
     */
    protected static function parse($markdown, $parse_as_line = false): string
    {
        if (class_exists('\GrahamCampbell\Markdown\Facades\Markdown') and app()->has('markdown')) {
            $parser = app()->make('markdown');
            if ($parse_as_line) {
                //TODO: parse, but don't wrap in <p>
            }
            return $parser->convertToHtml($markdown);
        }

        if (class_exists('\Parsedown')) {
            if ($parse_as_line) {
                return \Parsedown::instance()->line($markdown);
            }
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
    public function toHtml(): string
    {
        return self::parse($this->markdown, $this->parse_as_line);
    }
}
