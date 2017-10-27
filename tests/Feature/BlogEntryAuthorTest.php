<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Eloquent\BlogEntry;
use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class BlogEntryAuthorTest extends IntegrationTest
{
    public function setUp()
    {
        parent::setUp();
        $this->loadRegisteredMigrations();
        $this->seedDefaultBlogEntry();
    }

    protected function setEntryAuthor($name, $email = null, $url = null)
    {
        $entry = BlogEntry::first();
        $entry->author_name = $name;
        if ($email) {
            $entry->author_email = $email;
        }
        if ($url) {
            $entry->author_url = $url;
        }
        $entry->save();
    }

    public function test_author_name()
    {
        $this->setEntryAuthor('A Name');

        $response = $this->get('blog/the-first-post');

        $response->assertSee('A Name');
    }

    public function test_author_email()
    {
        $this->setEntryAuthor('A Name', 'an@email.com');

        $response = $this->get('blog/the-first-post');

        $response->assertSee('A Name');
        $response->assertSee('mailto:an@email.com');
    }

    public function test_author_url()
    {
        $this->setEntryAuthor('A Name', 'an@email.com', 'http://domain.com/me');

        $response = $this->get('blog/the-first-post');

        $response->assertSee('A Name');
        $response->assertDontSee('mailto:an@email.com');
        $response->assertSee('http://domain.com/me');
    }
}
