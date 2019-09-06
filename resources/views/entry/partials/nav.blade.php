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
    <ul>
    @if($nextEntry)
      <li class="blog-next-entry"><a href="{{ $blog->urlToEntry($nextEntry) }}" rel="next" class="blog-entry-link">
        <small>{{ __($blog->transKey('titles.next')) }}<span>:</span></small>
        <span class="blog-entry-title">{{ $nextEntry->getTitle() }}</span>
      </a></li>
    @endif
    @if($previousEntry)
      <li class="blog-previous-entry"><a href="{{ $blog->urlToEntry($previousEntry) }}" rel="prev" class="blog-entry-link">
        <small>{{ __($blog->transKey('titles.previous')) }}<span>:</span></small>
        <span class="blog-entry-title">{{ $previousEntry->getTitle() }}</span>
      </a></li>
    @endif
    </ul>
  @show
</nav>
@endif
