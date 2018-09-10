<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<article class="blog-entry-short" @includeWhen($entry->getImageUrl(), $blog->bladeView('entry.partials.imageStyle'))>
  <header class="blog-entry-header">
    <h2 class="blog-entry-title">{{ $entry->getTitle() }}</h2>
  </header>
  <div class="blog-entry-summary">
    {{ $entry->getSummary() }}
  </div>
  <footer class="blog-entry-footer">
    <small><time datetime="{{ $entry->getPublished()->toAtomString() }}" lang="en">{{ $entry->getPublished()->diffForHumans() }}</time></small>
  </footer>
</article>
