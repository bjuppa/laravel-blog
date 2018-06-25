<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 */
?>
@extends($blog->bladeView('layouts.html'))

@section('body')
  <main class="blog container">
    @yield('blog')
  </main>
@endsection

@push('styles')
  @foreach($blog->stylesheetUrls() as $stylesheet)
    <link href="{{ url($stylesheet) }}" rel="stylesheet" type="text/css">
  @endforeach
@endpush
