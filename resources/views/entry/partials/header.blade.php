<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<header class="blog-entry-header">
  @section('blogEntryHeader')
    @if($entry->getImage())
      {{ $entry->getImage() }}
    @endif
    <h1 class="blog-entry-title" itemprop="headline">{{ $entry->getTitle() }}</h1>
  @show
</header>
