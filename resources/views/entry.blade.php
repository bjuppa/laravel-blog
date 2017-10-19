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
      @include('blog::entry.authors', ['authors' => $entry->getAuthors()])
      <time datetime="{{-- TODO: print publish datetime --}}">{{-- TODO: display publish time for humans --}}</time>
      </p>
    </footer>
    <div>
      {{ $entry->getContent() }}
    </div>
  </article>
@endsection
