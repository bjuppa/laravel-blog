<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 */
?>
<small><a aria-label="{{ __($blog->transKey('feed.atom_subscribe'), ['blog' => $blog->getTitle()]) }}"
    href="{{ $blog->urlToFeed() }}" type="application/atom+xml" rel="alternate">
    {{__($blog->transKey('feed.subscribe'))}}
  </a></small>
