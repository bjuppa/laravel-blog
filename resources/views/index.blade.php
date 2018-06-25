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
    {{-- TODO: set title="Latest entries" to the entry list --}}
    <ul class="blog-entry-list list-unstyled">
      @each($blog->bladeView('entry.listItem'), $entries, 'entry')
    </ul>
  @endif
@endsection
