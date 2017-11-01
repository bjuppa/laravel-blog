<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<article>
  @includeFirst(['blog::entry.partials.header-'.$blog->getId().'-'.$entry->getId(), 'blog::entry.partials.header-'.$blog->getId(), 'blog::entry.partials.header'])
  @includeFirst(['blog::entry.partials.footer-'.$blog->getId().'-'.$entry->getId(), 'blog::entry.partials.footer-'.$blog->getId(), 'blog::entry.partials.footer'])
  @includeFirst(['blog::entry.partials.content-'.$blog->getId().'-'.$entry->getId(), 'blog::entry.partials.content-'.$blog->getId(), 'blog::entry.partials.content'])
  {{-- TODO: add nav here with links to next and previous entries --}}
  @includeFirst(['blog::entry.partials.aside-'.$blog->getId().'-'.$entry->getId(), 'blog::entry.partials.aside-'.$blog->getId(), 'blog::entry.partials.aside'])
</article>
