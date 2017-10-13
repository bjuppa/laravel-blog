@extends('blog::layouts.blog')

@section('blog')
  @each('blog::entry.short', $entries, 'entry')
@endsection
