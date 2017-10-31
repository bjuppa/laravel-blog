<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 */
?>
<footer>
  <p>
    <time datetime="{{ $entry->getPublished()->toAtomString() }}">{{ $entry->getPublished()->diffForHumans() }}</time>
    <a href="{{ $blog->urlToIndex() }}" rel="index">{{ $blog->getTitle() }}</a>
    @includeFirst(['blog::entry.partials.authors-'.$blog->getId().'-'.$entry->getId(), 'blog::entry.partials.authors-'.$blog->getId(), 'blog::entry.partials.authors'], ['authors' => $entry->getAuthors()->isEmpty() ? $blog->getAuthors() : $entry->getAuthors()])
  </p>
</footer>
