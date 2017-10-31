@extends('blog::layouts.blog')

<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>

@push('meta')
  @include('blog::feed.metaLink')
  @if($entry->getMetaDescription())
    <meta name="description" content="{{ $entry->getMetaDescription() }}">
  @endif
@endpush

@section('blog')
  @includeFirst(['blog::entry.full-'.$blog->getId().'-'.$entry->getId(), 'blog::entry.full-'.$blog->getId(), 'blog::entry.full'])
@endsection
