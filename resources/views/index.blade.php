@extends('blog::layouts.blog')

@push('meta')
  @include('blog::feed.meta_link')
@endpush

@section('blog')
  {{-- TODO: wrap the short entries in a list of links --}}
  @each('blog::entry.short', $entries, 'entry')
@endsection
