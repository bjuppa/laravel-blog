@extends('blog::layouts.blog')

@push('meta')
  @include('blog::feed.meta_link')
@endpush

@section('blog')
  @include('blog::entry.full')
@endsection
