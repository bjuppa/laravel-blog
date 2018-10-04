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
      <a href="{{ $blog->urlToEntry($nextEntry) }}" rel="next" class="blog-entry-link" itemscope itemtype="http://schema.org/BlogPosting">
        <small>{{ __($blog->transKey('titles.next')) }}<span>:</span></small>
        <span itemprop="headline">{{ $nextEntry->getTitle() }}</span>
      </a>
    @endif
    @if($previousEntry)
      <a href="{{ $blog->urlToEntry($previousEntry) }}" rel="prev" class="blog-entry-link" itemscope itemtype="http://schema.org/BlogPosting">
        <small>{{ __($blog->transKey('titles.previous')) }}<span>:</span></small>
        <span itemprop="headline">{{ $previousEntry->getTitle() }}</span>
      </a>
    @endif
  @show
</nav>
@endif
