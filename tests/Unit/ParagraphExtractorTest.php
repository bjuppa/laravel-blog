<?php

namespace Bjuppa\LaravelBlog\Tests\Unit;

use Bjuppa\LaravelBlog\Support\ParagraphExtractor;
use Bjuppa\LaravelBlog\Tests\UnitTest;

class ParagraphExtractorTest extends UnitTest
{
    public function test_splitting_paragraphs()
    {
        $html_string = "<p>1</p><p a='b'>2</p> <p>3</p>\n<p>4</p>";
        $ps = ParagraphExtractor::explodeParagraphs($html_string);

        $this->assertCount(4, $ps);
        $this->assertEquals("<p>1</p>", $ps->get(0));
        $this->assertEquals("<p a='b'>2</p>", $ps->get(1));
        $this->assertEquals("<p>3</p>", $ps->get(2));
        $this->assertEquals("<p>4</p>", $ps->get(3));
    }
}
