<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<article class="blog-entry-short">
  <header class="blog-entry-header">
    <h2 class="blog-entry-title">{{ $entry->getTitle() }}</h2>
  </header>
  <div class="blog-entry-summary">
    {{ $entry->getSummary() }}
  </div>
  <footer class="blog-entry-footer">
    <time datetime="{{ $entry->getPublished()->toAtomString() }}" lang="en">{{ $entry->getPublished()->diffForHumans() }}</time>
  </footer>
  {{-- TODO: if image is to be added to short entries, it's probably here --}}
</article>
