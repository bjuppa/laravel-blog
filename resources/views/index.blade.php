<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 * @var $entries \Illuminate\Support\Collection
 */
?>
@extends($blog->bladeView('layouts.blog'))

@section('title', $blog->getPageTitle())

@push('meta')
  @includeFirst($blog->bladeViews('feed.metaLink'))
  @foreach($blog->getMetaTags() as $meta_tag_attributes)
    <meta {!! collect($meta_tag_attributes)->map(function($item, $key) {
      return $key . '="' . htmlspecialchars($item) . '"';
    })->implode(' ') !!}>
  @endforeach
  @if($blog->getMetaDescription())
    <meta name="description" content="{{ $blog->getMetaDescription() }}">
  @endif
  <meta name="twitter:card" content="summary">
  <meta property="og:title" content="{{ $blog->getTitle() }}">
@endpush

@push('head')
  <link rel="canonical" href="{{ $blog->urlToIndex() }}" />
@endpush

@section('blog')
  @includeFirst($blog->bladeViews('blog.header'))
  @if($entries->count())
    <ul class="blog-entry-list list-unstyled" title="{{ __($blog->transKey('titles.latest_entries')) }}">
      @each($blog->bladeView('entry.listItem'), $entries, 'entry')
    </ul>
  @endif
@endsection
