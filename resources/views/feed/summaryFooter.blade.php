<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<footer>
<a href="{{ $blog->urlToEntry($entry) }}">{{ __($blog->transKey('feed.read_more')) }} {{ $blog->urlToEntry($entry) }}</a>
</footer>
