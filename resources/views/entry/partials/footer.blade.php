<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 */
?>
<footer class="blog-entry-footer">
  @section('blogEntryFooter')
    <p lang="en" class="blog-entry-publication-info">
      Published
      <time datetime="{{ $entry->getPublished()->toAtomString() }}">{{ $entry->getPublished()->diffForHumans() }}</time>
      in
      <a href="{{ $blog->urlToIndex() }}" rel="index">{{ $blog->getTitle() }}</a>
      by
      @includeFirst(['blog::entry.partials.authors-'.$blog->getId().'-'.$entry->getId(), 'blog::entry.partials.authors-'.$blog->getId(), 'blog::entry.partials.authors'], ['authors' => $entry->getAuthors()->isEmpty() ? $blog->getAuthors() : $entry->getAuthors()])
    </p>
  @show
</footer>
