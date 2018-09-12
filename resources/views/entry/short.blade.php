<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<article class="blog-entry-short" @includeWhen($entry->getImageUrl(), $blog->bladeView('entry.partials.imageStyle'))>
  <header class="blog-entry-header">
    <h2 class="blog-entry-title"><a href="{{ $blog->urlToEntry($entry) }}">{{ $entry->getTitle() }}</a></h2>
  </header>
  <div class="blog-entry-summary">
    {{ $entry->getSummary() }}
  </div>
  <footer class="blog-entry-footer">
    <small><time datetime="{{ $entry->getPublished()->toAtomString() }}" lang="en">{{ $entry->getPublished()->diffForHumans() }}</time></small>
    <a href="{{ $blog->urlToEntry($entry) }}">
      <small>{{ __($blog->transKey('titles.read_entry')) }}<span>:</span></small>
      <small>{{ $entry->getTitle() }}</small>
    </a>
  </footer>
</article>
