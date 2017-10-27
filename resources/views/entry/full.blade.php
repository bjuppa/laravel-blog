<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<article>
  {{-- TODO: use @includeFirst() here for special header display per blog and entry --}}
  @include('blog::entry.partials.header')
  {{-- TODO: use @includeFirst() here for special footer display per blog and entry --}}
  @include('blog::entry.partials.footer')
  {{-- TODO: use @includeFirst() here for special content display per blog and entry --}}
  @include('blog::entry.partials.content')
</article>
