<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<ol class="blog-latest-entries-links" aria-label="{{ __($blog->transKey('titles.latest_entries')) }}">
  @foreach($blog->latestEntries() as $entry)
    <li>
      <a href="{{ $blog->urlToEntry($entry) }}" class="blog-entry-link">{{ $entry->getTitle() }}</a>
    </li>
  @endforeach
</ol>
