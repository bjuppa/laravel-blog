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
      <time datetime="{{ $entry->getPublished()->toAtomString() }}">{{ $entry->getPublished()->diffForHumans() }}</time>
      </p>
    </footer>
    <div>
      {{ $entry->getContent() }}
    </div>
  </article>
@endsection
