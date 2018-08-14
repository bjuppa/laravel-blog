<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 */
$nextEntry = $blog->nextEntry($entry);
$previousEntry = $blog->previousEntry($entry);
?>
@if($nextEntry or $previousEntry)
<nav class="blog-entry-nav">
  @section('blogEntryNav')
    @if($nextEntry)
      <a href="{{ $blog->urlToEntry($nextEntry) }}" rel="next" class="blog-entry-link">{{ $nextEntry->getTitle() }}</a>
    @endif
    @if($previousEntry)
      <a href="{{ $blog->urlToEntry($previousEntry) }}" rel="prev" class="blog-entry-link">{{ $previousEntry->getTitle() }}</a>
    @endif
  @show
</nav>
@endif
