<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<article>
  <h2>{{ $entry->getTitle() }}</h2>
  {{ $entry->getSummary() }}
</article>
