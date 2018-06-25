<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<li>
  <a href="{{ $blog->urlToEntry($entry) }}" class="blog-entry-link">
    @includeFirst($entry->bladeViews('short', $blog))
  </a>
</li>
