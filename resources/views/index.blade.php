@extends('blog::layouts.blog')

@section('blog')
  {{-- TODO: wrap the short entries in a list of links --}}
  @each('blog::entry.short', $entries, 'entry')
@endsection
