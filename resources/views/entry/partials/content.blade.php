<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<div class="blog-entry-content">
  <hr class="blog-content-start">

  {{ $entry->getContent() }}

  <hr class="blog-content-end">
</div>
