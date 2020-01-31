<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 */
?>
@extends($blog->bladeView('layouts.html'))

@includeFirst($blog->bladeViews('custom.all-pages'))

@section('body')
  <main class="blog" itemscope itemtype="http://schema.org/Blog">
    @yield('blog')
  </main>
@endsection

@push('styles')
  @foreach($blog->stylesheetUrls() as $stylesheet)
    <link href="{{ url($stylesheet) }}" rel="stylesheet" type="text/css">
  @endforeach
@endpush
