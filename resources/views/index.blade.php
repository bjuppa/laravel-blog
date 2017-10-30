@extends('blog::layouts.blog')

<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 * @var $entries \Illuminate\Support\Collection
 */
?>

@push('meta')
  @include('blog::feed.meta_link')
@endpush

@section('blog')
  <h1>{{ $blog->getTitle() }}</h1>
  @if($entries->count())
    <ul>
      @each('blog::entry.list_item', $entries, 'entry')
    </ul>
  @endif
@endsection
