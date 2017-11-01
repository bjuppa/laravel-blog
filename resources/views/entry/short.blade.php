<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<article class="blog-entry">
  <h2>{{ $entry->getTitle() }}</h2>
  {{ $entry->getSummary() }}
</article>
