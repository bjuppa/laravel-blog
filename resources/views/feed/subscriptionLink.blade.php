<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 */
?>
<a href="{{ $blog->urlToFeed() }}" type="application/atom+xml"
  rel="alternate">{{ __($blog->transKey('feed.subscribe'), ['blog' => $blog->getTitle()]) }}</a>
