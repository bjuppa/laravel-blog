<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<article class="blog-entry">
  @includeFirst($entry->bladeViews('partials.header', $blog))
  @includeFirst($entry->bladeViews('partials.footer', $blog))
  @includeFirst($entry->bladeViews('partials.content', $blog))
  {{-- TODO: add entry social sharing here, in aside --}}
  {{-- TODO: add nav here with links to next and previous entries --}}
  {{-- TODO: add entry comments here - nested <article> tags --}}
  @includeFirst($entry->bladeViews('partials.aside', $blog))
</article>
