<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<header>
  {{-- TODO: wrap this in a blade section blogEntryHeader --}}
  @if($entry->getImage())
    {{ $entry->getImage() }}
  @endif
  <h1>{{ $entry->getTitle() }}</h1>
</header>
