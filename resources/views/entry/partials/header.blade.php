<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<header>
  @if($entry->getImage())
    {{ $entry->getImage() }}
  @endif
  <h1>{{ $entry->getTitle() }}</h1>
</header>
