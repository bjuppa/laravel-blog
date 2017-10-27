<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<footer>
  <p>
    @includeFirst(['blog::entry.partials.authors-'.$blog->getId().'-'.$entry->getId(), 'blog::entry.partials.authors-'.$blog->getId(), 'blog::entry.partials.authors'], ['authors' => $entry->getAuthors()->isEmpty() ? $blog->getAuthors() : $entry->getAuthors()])
    <time datetime="{{ $entry->getPublished()->toAtomString() }}">{{ $entry->getPublished()->diffForHumans() }}</time>
  </p>
</footer>
