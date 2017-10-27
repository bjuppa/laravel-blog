<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<footer>
  <p>
    {{-- TODO: use the blog's default author if entry has no authors  --}}
    {{-- TODO: use @includeFirst() here for special author display per blog and entry --}}
    @include('blog::entry.partials.authors', ['authors' => $entry->getAuthors()])
    <time datetime="{{ $entry->getPublished()->toAtomString() }}">{{ $entry->getPublished()->diffForHumans() }}</time>
  </p>
</footer>
