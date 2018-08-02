<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
@extends($blog->bladeView('layouts.blog'), ['metaTags' => $entry])

@section('title', $entry->getPageTitle($blog->getEntryPageTitleSuffix()))

@push('head')
  <link rel="canonical" href="{{ $blog->urlToEntry($entry) }}" />
  @includeFirst($blog->bladeViews('feed.metaLink'))
@endpush

@section('blog')
  @includeFirst($blog->bladeViews('entry.full', $entry))
@endsection
