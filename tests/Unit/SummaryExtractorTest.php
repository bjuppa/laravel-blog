<?php

namespace Bjuppa\LaravelBlog\Tests\Unit;

use Bjuppa\LaravelBlog\Support\SummaryExtractor;
use Bjuppa\LaravelBlog\Tests\UnitTest;

class SummaryExtractorTest extends UnitTest
{
    public function test_top_level_paragraphs_are_extracted()
    {
        $html_string = "<p>1</p><p a='b'>2</p> <p>3</p>\n<p>4</p>";
        $ps = SummaryExtractor::extractParagraphs($html_string);

        $this->assertCount(4, $ps);
        $this->assertEquals("<p>1</p>", $ps->get(0));
        $this->assertEquals("<p a='b'>2</p>", $ps->get(1));
        $this->assertEquals("<p>3</p>", $ps->get(2));
        $this->assertEquals("<p>4</p>", $ps->get(3));
    }

    public function test_paragraph_extraction_is_unaffected_by_lg_in_attribute()
    {
        $html_string = "<p a='>'>1</p><p>2</p>";
        $ps = SummaryExtractor::extractParagraphs($html_string);

        $this->assertCount(2, $ps);
        $this->assertEquals("<p a='>'>1</p>", $ps->get(0));
        $this->assertEquals("<p>2</p>", $ps->get(1));
    }

    public function test_child_paragraphs_are_extracted()
    {
        $html_string = "<p>1</p><div><p>A</p><p>B</p></div><p>2</p>";
        $ps = SummaryExtractor::extractParagraphs($html_string);

        $this->assertCount(4, $ps);
        $this->assertEquals("<p>1</p>", $ps->get(0));
        $this->assertEquals("<p>A</p>", $ps->get(1));
        $this->assertEquals("<p>B</p>", $ps->get(2));
        $this->assertEquals("<p>2</p>", $ps->get(3));
    }
}
