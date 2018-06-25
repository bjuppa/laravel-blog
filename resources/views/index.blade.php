@extends('blog::layouts.blog')

<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 * @var $entries \Illuminate\Support\Collection
 */
?>

@section('title', $blog->getPageTitle())

@push('meta')
  @include('blog::feed.metaLink')
  @if($blog->getMetaDescription())
    <meta name="description" content="{{ $blog->getMetaDescription() }}">
  @endif
@endpush

@section('blog')
  @includeFirst($blog->bladeViews('blog.header'))
  @if($entries->count())
    {{-- TODO: set title="Latest entries" to the entry list --}}
    <ul class="blog-entry-list list-unstyled">
      @each('blog::entry.listItem', $entries, 'entry')
    </ul>
  @endif
@endsection
