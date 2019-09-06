<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 */
?>
<footer class="blog-entry-footer">
  @section('blogEntryFooter')
    <div lang="en" dir="ltr" class="blog-entry-publication-info">
      @if($entry->isPublic())
        Published
      @else
        Preview
        @if($entry->getPublished()->isFuture())
          scheduled for publishing
        @else
          created
        @endif
      @endif
      <time datetime="{{ $blog->convertToBlogTimezone($entry->getPublished())->toAtomString() }}" itemprop="datePublished">{{ $entry->getPublished()->diffForHumans() }}</time>
      in
      <a href="{{ $blog->urlToIndex() }}" rel="index" class="blog-title" itemprop="isPartOf" itemscope itemtype="http://schema.org/Blog">{{ $blog->getTitle() }}</a>
      by
      @includeFirst($blog->bladeViews('entry.partials.authors', $entry), ['authors' => $entry->getAuthors()->isEmpty() ? $blog->getAuthors() : $entry->getAuthors()])
    </div>
  @show
</footer>
