<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 */
?>
<a href="{{ $blog->urlToFeed() }}" type="application/atom+xml"
  rel="alternate">{{ __($blog->transKey('feed.atom_subscribe'), ['blog' => $blog->getTitle()]) }}</a>
