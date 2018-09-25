<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 */
?>
<footer class="blog-entry-footer">
  @section('blogEntryFooter')
    <div lang="en" class="blog-entry-publication-info">
      Published
      <time datetime="{{ $entry->getPublished()->toAtomString() }}">{{ $entry->getPublished()->diffForHumans() }}</time>
      in
      <a href="{{ $blog->urlToIndex() }}" rel="index">{{ $blog->getTitle() }}</a>
      by
      @includeFirst($blog->bladeViews('entry.partials.authors', $entry), ['authors' => $entry->getAuthors()->isEmpty() ? $blog->getAuthors() : $entry->getAuthors()])
    </div>
  @show
</footer>
