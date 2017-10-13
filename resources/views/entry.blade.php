@extends('blog::layouts.blog')

<?php
  /**
   * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
   */
?>

@section('blog')
  <h1>{{ $entry->getHeadline() }}</h1>
  {{ $entry->getBody() }}
@endsection
