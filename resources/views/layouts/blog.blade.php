@extends('blog::layouts.html')

<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 */
?>

@section('body')
  <main class="blog">
    @yield('blog')
  </main>
@endsection

@push('styles')
  @foreach($blog->getStylesheets() as $stylesheet)
    <link href="{{ url($stylesheet) }}" rel="stylesheet" type="text/css">
  @endforeach
@endpush
