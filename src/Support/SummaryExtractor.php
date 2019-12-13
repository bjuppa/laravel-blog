<?php

namespace Bjuppa\LaravelBlog\Support;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;

class SummaryExtractor
{
    /**
     * Get a regular expression matching a specific html element
     * @param string $tag Name of tag
     * @return string
     */
    protected static function htmlTagPattern($tag)
    {
        return "/<$tag(\s+(\w+)\s*=\s*(\".*?\"|'.*?'|[^>\"'\s]+))*\s*>.*?<\/$tag>/s";
    }

    /**
     * Split html string into chunks of one paragraph tag each.
     * @param string|Htmlable $html
     * @return Collection
     */
    public static function extractParagraphs($html): Collection
    {
        if ($html instanceof Htmlable) {
            $html = $html->toHtml();
        }
        preg_match_all(self::htmlTagPattern('p'), $html, $matches);
        return collect($matches[0]);
    }

    /**
     * Take paragraphs from a collection until they contain enough characters.
     * Html tags are not counted, only plain text.
     * @param Collection $paragraphs
     * @param int $character_threshold
     * @return Collection
     */
    public static function takeWithCharacterThreshold(
        Collection $paragraphs,
        int $character_threshold = 500
    ): Collection {
        $intro_paragraphs = new Collection();
        $intro_characters = 0;
        foreach ($paragraphs as $paragraph) {
            if ($intro_characters > $character_threshold) {
                break;
            }
            $intro_paragraphs->push($paragraph);
            $intro_characters += strlen(strip_tags($paragraph));
        }

        return $intro_paragraphs;
    }

    /**
     * Remove up to half of the last paragraph, without breaking html tags.
     * @param string $paragraph
     * @param string $end
     * @return string
     */
    public static function truncateParagraph(string $paragraph, $end = '...'): string
    {
        $word_count = str_word_count(strip_tags($paragraph));
        return preg_replace('/(?:[^>\w]+\w*){0,' . floor($word_count / 2) . '}<\/p>$/', $end . '</p>', $paragraph);
    }
}
