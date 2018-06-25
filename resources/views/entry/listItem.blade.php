<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<li>
  <a href="{{ $blog->urlToEntry($entry) }}" class="blog-entry-link">
    @includeFirst($blog->bladeViews('entry.short', $entry))
  </a>
</li>
