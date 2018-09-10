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
      <a href="{{ $blog->urlToEntry($nextEntry) }}" rel="next" class="blog-entry-link">
        <span>{{ __($blog->transKey('titles.next')) }}<span>:</span></span>
        <span>{{ $nextEntry->getTitle() }}</span>
      </a>
    @endif
    @if($previousEntry)
      <a href="{{ $blog->urlToEntry($previousEntry) }}" rel="prev" class="blog-entry-link">
        <span>{{ __($blog->transKey('titles.previous')) }}<span>:</span></span>
        <span>{{ $previousEntry->getTitle() }}</span>
      </a>
    @endif
  @show
</nav>
@endif
