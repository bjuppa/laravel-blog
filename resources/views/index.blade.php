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
  @if($blog->getMetaDescription())
    <meta name="description" content="{{ $blog->getMetaDescription() }}">
  @endif
@endpush

@section('blog')
  @includeFirst($blog->bladeViews('blog.header'))
  @if($entries->count())
    <ul class="blog-entry-list list-unstyled" title="{{ __($blog->transKey('titles.latest_entries')) }}">
      @each($blog->bladeView('entry.listItem'), $entries, 'entry')
    </ul>
  @endif
@endsection
