<?php
use Bjuppa\MetaTagBag\MetaTagBag;
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 * @var $entries \Illuminate\Support\Collection
 */
?>
@extends($blog->bladeView('layouts.blog'))

@section('title', $blog->getPageTitle())

@push('meta')
  {{
    MetaTagBag::make(
      ["name" => "twitter:card", "content" => "summary"],
      ["property" => "og:title", "content" => $blog->getTitle()]
    )
    ->merge($blog->getMetaTags())
  }}
  @includeFirst($blog->bladeViews('feed.metaLink'))
  @if($blog->getMetaDescription())
    <meta name="description" content="{{ $blog->getMetaDescription() }}">
  @endif
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
