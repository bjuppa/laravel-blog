<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
@extends($blog->bladeView('layouts.blog'), ['metaTags' => $entry])

@section('title', $entry->getPageTitle($blog->getEntryPageTitleSuffix()))

@push('head')
  {{-- TODO: move all meta tag generation into the BlogEntry class --}}
  @if($entry->getMetaDescription())
    <meta name="description" content="{{ $entry->getMetaDescription() }}">
  @endif
  @if($entry->getImageUrl())
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:image" content="{{ $entry->getImageUrl() }}">
  @else
    <meta name="twitter:card" content="summary">
  @endif
@endpush

@push('head')
  <link rel="canonical" href="{{ $blog->urlToEntry($entry) }}" />
  @includeFirst($blog->bladeViews('feed.metaLink'))
@endpush

@section('blog')
  @includeFirst($blog->bladeViews('entry.full', $entry))
@endsection
