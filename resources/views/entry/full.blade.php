<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<article class="blog-entry">
  @includeFirst($blog->bladeViews('entry.partials.header', $entry))
  @includeFirst($blog->bladeViews('entry.partials.footer', $entry))
  @includeFirst($blog->bladeViews('entry.partials.content', $entry))
  @includeFirst($blog->bladeViews('blog.socialSharingAside', $entry))
  {{-- TODO: add nav here with links to next and previous entries --}}
  {{-- TODO: add entry comments here - nested <article> tags --}}
  @includeFirst($blog->bladeViews('entry.partials.aside', $entry))
</article>
