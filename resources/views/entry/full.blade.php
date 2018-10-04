<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<article class="blog-entry" itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting">
  @includeFirst($blog->bladeViews('entry.partials.header', $entry))
  @includeFirst($blog->bladeViews('entry.partials.footer', $entry))
  @includeFirst($blog->bladeViews('entry.partials.content', $entry))
  @includeFirst($blog->bladeViews('blog.socialSharingAside', $entry))
  @includeFirst($blog->bladeViews('entry.partials.nav', $entry))
  @includeFirst($blog->bladeViews('entry.partials.adsAside'))
  {{-- TODO: add entry comments here - nested <article> tags --}}
  @includeFirst($blog->bladeViews('entry.partials.relatedContent', $entry))
</article>
