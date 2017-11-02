<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<header class="blog-entry-header">
  {{-- TODO: wrap this in a blade section blogEntryHeader --}}
  @if($entry->getImage())
    {{ $entry->getImage() }}
  @endif
  <h1 class="blog-entry-title">{{ $entry->getTitle() }}</h1>
</header>
