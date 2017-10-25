<?php

namespace Bjuppa\LaravelBlog\Tests\Unit;

use Bjuppa\LaravelBlog\Support\SummaryExtractor;
use Bjuppa\LaravelBlog\Tests\UnitTest;

class SummaryExtractorTest extends UnitTest
{
    public function test_splitting_paragraphs()
    {
        $html_string = "<p>1</p><p a='b'>2</p> <p>3</p>\n<p>4</p>";
        $ps = SummaryExtractor::splitParagraphs($html_string);

        $this->assertCount(4, $ps);
        $this->assertEquals("<p>1</p>", $ps->get(0));
        $this->assertEquals("<p a='b'>2</p>", $ps->get(1));
        $this->assertEquals("<p>3</p>", $ps->get(2));
        $this->assertEquals("<p>4</p>", $ps->get(3));
    }

    //TODO: test splitting <p>1</p><div><p>A</p><p>B</p></div><p>2</p> and make sure it doesn't split the nested paragraphs
}
