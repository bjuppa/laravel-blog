@extends('blog::layouts.blog')

<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>

@section('title', $entry->getPageTitle($blog->getEntryPageTitleSuffix()))

@push('meta')
  @include('blog::feed.metaLink')
  @if($entry->getMetaDescription())
    <meta name="description" content="{{ $entry->getMetaDescription() }}">
  @endif
@endpush

@section('blog')
  @includeFirst($blog->bladeViews('entry.full', $entry))
@endsection
