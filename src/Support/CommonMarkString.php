<?php

namespace Bjuppa\LaravelBlog\Support;

use Bjuppa\LaravelBlog\Contracts\MarkdownString;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;

class CommonMarkString implements MarkdownString
{
    /**
     * @var string
     */
    protected $markdown;

    /**
     * CommonMarkString constructor.
     * @param string $markdown
     */
    public function __construct($markdown = '')
    {
        $this->markdown = $markdown;
    }

    /**
     * Create a new instance of MarkdownString
     * @param string $markdown
     */
    public static function create(string $markdown): MarkdownString
    {
        return new self($markdown);
    }

    /**
     * Parse given markdown to html
     * @param $markdown
     * @return string
     */
    protected static function parse($markdown): string
    {
        $environment = Environment::createCommonMarkEnvironment();

        $converter = new CommonMarkConverter([
            'allow_unsafe_links' => false,
        ], $environment);

        return $converter->convertToHtml($markdown);
    }

    /**
     * Get content as a string of HTML.
     *
     * @return string
     */
    public function toHtml(): string
    {
        return self::parse($this->markdown);
    }
}
