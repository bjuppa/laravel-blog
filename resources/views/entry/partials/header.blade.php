<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<header>
  {{-- TODO: display main image --}}
  <h1>{{ $entry->getTitle() }}</h1>
</header>
