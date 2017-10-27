<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<article>
  @includeFirst(['blog::entry.partials.header-'.$blog->getId().'-'.$entry->getId(), 'blog::entry.partials.header-'.$blog->getId(), 'blog::entry.partials.header'])
  @includeFirst(['blog::entry.partials.footer-'.$blog->getId().'-'.$entry->getId(), 'blog::entry.partials.footer-'.$blog->getId(), 'blog::entry.partials.footer'])
  @includeFirst(['blog::entry.partials.content-'.$blog->getId().'-'.$entry->getId(), 'blog::entry.partials.content-'.$blog->getId(), 'blog::entry.partials.content'])
</article>
