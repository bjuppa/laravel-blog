<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<li>
  <a href="{{ $blog->urlToEntry($entry) }}">
    @includeFirst(['blog::entry.short-'.$blog->getId().'-'.$entry->getId(), 'blog::entry.short-'.$blog->getId(), 'blog::entry.short'])
  </a>
</li>
