@extends('blog::layouts.blog')

<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>

@section('blog')
  <article>
    <header>
      {{-- TODO: display main image --}}
      <h1>{{ $entry->getTitle() }}</h1>
    </header>
    <footer>
      <p>
      {{-- TODO: display author name without <address> if no link --}}
      <address>{{-- TODO: display author link (mailto or url) --}}</address>
      <time datetime="{{-- TODO: print publish datetime --}}">{{-- TODO: display publish time for humans --}}</time>
      </p>
    </footer>
    <div>
      {{ $entry->getContent() }}
    </div>
  </article>
@endsection
