<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class SocialSharingTest extends IntegrationTest
{
    public function setUp(): void
    {
        parent::setUp();
        $this->loadRegisteredMigrations();
        $this->seedDefaultBlogEntry();
    }

    public function test_meta_tags_on_blog()
    {
        $response = $this->get('blog');

        $response->assertSee('<meta property="og:type" content="blog">', false);
        $response->assertSee('<meta property="og:title" content="Main Blog">', false);
        $response->assertSee('<meta name="twitter:card" content="summary">', false);
    }

    public function test_meta_tags_on_entry()
    {
        $response = $this->get('blog/the-first-post');

        $response->assertSee('<meta property="og:type" content="article">', false);
        $response->assertSee('<meta property="og:title" content="The first post">', false);
        $response->assertSee('<meta name="twitter:card" content="summary">', false);
        $response->assertSee('<meta property="article:published_time" content="', false);
        $response->assertSee('<meta property="article:modified_time" content="', false);
    }

    public function test_sharing_section()
    {
        $response = $this->get('blog/the-first-post');

        $response->assertSee('>Share this page<', false);
        $response->assertSee('<ul aria-label="Links for sharing this page">', false);
    }

    // Source of link formats: https://github.com/bradvin/social-share-urls

    public function test_facebook_link()
    {
        $response = $this->get('blog/the-first-post');

        $response->assertSee('<li class="share-on-facebook">', false);
        $response->assertSee('<a href="https://www.facebook.com/sharer.php?u=http%3A%2F%2Flocalhost%2Fblog%2Fthe-first-post" target="_blank" rel="noopener">', false);
        $response->assertSee('><span class="share-link-prefix">Share this page on </span><span class="share-link-service">Facebook</span></a>', false);
    }

    public function test_twitter_link()
    {
        $response = $this->get('blog/the-first-post');

        $response->assertSee('<li class="share-on-twitter">', false);
        $response->assertSee('<a href="https://twitter.com/intent/tweet?url=http%3A%2F%2Flocalhost%2Fblog%2Fthe-first-post" target="_blank" rel="noopener">', false);
        $response->assertSee('><span class="share-link-prefix">Share this page on </span><span class="share-link-service">Twitter</span></a>', false);
    }

    public function test_linkedin_link()
    {
        $response = $this->get('blog/the-first-post');

        $response->assertSee('<li class="share-on-linked-in">', false);
        $response->assertSee('<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=http%3A%2F%2Flocalhost%2Fblog%2Fthe-first-post&amp;title=The+first+post+-+Main+Blog" target="_blank" rel="noopener">', false);
        $response->assertSee('><span class="share-link-prefix">Share this page on </span><span class="share-link-service">LinkedIn</span></a>', false);
    }

    public function test_pinterest_link()
    {
        $response = $this->get('blog/the-first-post');

        $response->assertSee('<li class="share-on-pinterest">', false);
        $response->assertSee('<a href="http://pinterest.com/pin/create/link/?url=http%3A%2F%2Flocalhost%2Fblog%2Fthe-first-post" target="_blank" rel="noopener">', false);
        $response->assertSee('><span class="share-link-prefix">Share this page on </span><span class="share-link-service">Pinterest</span></a>', false);
    }

    public function test_tumblr_link()
    {
        $response = $this->get('blog/the-first-post');

        $response->assertSee('<li class="share-on-tumblr">', false);
        $response->assertSee('<a href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=http%3A%2F%2Flocalhost%2Fblog%2Fthe-first-post&amp;title=The+first+post+-+Main+Blog" target="_blank" rel="noopener">', false);
        $response->assertSee('><span class="share-link-prefix">Share this page on </span><span class="share-link-service">Tumblr</span></a>', false);
    }

    public function test_reddit_link()
    {
        $response = $this->get('blog/the-first-post');

        $response->assertSee('<li class="share-on-reddit">', false);
        $response->assertSee('<a href="https://reddit.com/submit?url=http%3A%2F%2Flocalhost%2Fblog%2Fthe-first-post&amp;title=The+first+post+-+Main+Blog" target="_blank" rel="noopener">', false);
        $response->assertSee('><span class="share-link-prefix">Share this page on </span><span class="share-link-service">Reddit</span></a>', false);
    }

    public function test_digg_link()
    {
        $response = $this->get('blog/the-first-post');

        $response->assertSee('<li class="share-on-digg">', false);
        $response->assertSee('<a href="http://digg.com/submit?url=http%3A%2F%2Flocalhost%2Fblog%2Fthe-first-post" target="_blank" rel="noopener">', false);
        $response->assertSee('><span class="share-link-prefix">Share this page on </span><span class="share-link-service">Digg</span></a>', false);
    }
}
