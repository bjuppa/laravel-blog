<?php

namespace Bjuppa\LaravelBlog\Support;


use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;

class SummaryExtractor
{
    public static function explodeParagraphs($html): Collection
    {
        if($html instanceof Htmlable) {
            $html = $html->toHtml();
        }

        return collect(preg_split('/(?<=<\/p>)\s*(?=<p(?:>|\s))/', $html));
    }
}
