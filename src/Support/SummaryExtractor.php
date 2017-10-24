<?php

namespace Bjuppa\LaravelBlog\Support;


use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;

class SummaryExtractor
{
    /**
     * Split html string into chunks of one paragraph tag each
     * @param $html
     * @return Collection
     */
    public static function splitParagraphs($html): Collection
    {
        if($html instanceof Htmlable) {
            $html = $html->toHtml();
        }

        return collect(preg_split('/(?<=<\/p>)\s*(?=<p(?:>|\s))/', $html));
    }
}
