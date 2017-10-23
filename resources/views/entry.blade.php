@extends('blog::layouts.blog')

<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>

@section('blog')
  @include('blog::entry.full')
@endsection
