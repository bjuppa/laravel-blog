<?php

namespace Bjuppa\LaravelBlog\Tests\Unit;


use Bjuppa\LaravelBlog\Support\Author;
use Bjuppa\LaravelBlog\Tests\UnitTest;

class AuthorTest extends UnitTest
{
    public function test_constructor_with_author_contract()
    {
        $authorA = new Author(['name' => 'Firstname Lastname', 'email' => 'test@test.com', 'url' => 'http://www.url.com']);
        $authorB = new Author($authorA);

        $this->assertEquals($authorA->getName(), $authorB->getName());
        $this->assertEquals($authorA->getEmail(), $authorB->getEmail());
        $this->assertEquals($authorA->getUrl(), $authorB->getUrl());
    }

    public function test_constructor_with_string()
    {
        $author = new Author('Firstname Lastname');

        $this->assertEquals('Firstname Lastname', $author->getName());
        $this->assertNull($author->getEmail());
        $this->assertNull($author->getUrl());
    }

    public function test_constructor_with_keyed_array()
    {
        $author = new Author([
            'name' => 'Firstname Lastname',
            'email' => 'test@test.com',
            'url' => 'http://www.url.com'
        ]);

        $this->assertEquals('Firstname Lastname', $author->getName());
        $this->assertEquals('test@test.com', $author->getEmail());
        $this->assertEquals('http://www.url.com', $author->getUrl());
    }

    public function test_constructor_with_numeric_array()
    {
        $author = new Author(['Firstname', 'Lastname', 'test@test.com', 'http://www.url.com']);

        $this->assertEquals('Firstname Lastname', $author->getName());
        $this->assertEquals('test@test.com', $author->getEmail());
        $this->assertEquals('http://www.url.com', $author->getUrl());
    }
}
