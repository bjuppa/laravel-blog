<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
@extends($blog->bladeView('layouts.blog'))

@section('title', $entry->getPageTitle($blog->getEntryPageTitleSuffix()))

@push('meta')
  @includeFirst($blog->bladeViews('feed.metaLink'))
  @if($entry->getMetaDescription())
    <meta name="description" content="{{ $entry->getMetaDescription() }}">
  @endif
  <meta property="og:title" content="{{ $entry->getTitle() }}">
  <meta property="og:type" content="article">
  @if($entry->getImageUrl())
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:image" content="{{ $entry->getImageUrl() }}">
  @else
    <meta name="twitter:card" content="summary">
  @endif
@endpush

@section('blog')
  @includeFirst($blog->bladeViews('entry.full', $entry))
@endsection
