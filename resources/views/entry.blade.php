@extends('blog::layouts.blog')

@push('meta')
  @include('blog::feed.meta_link')
@endpush

@section('blog')
  @includeFirst(['blog::entry.full-'.$blog->getId().'-'.$entry->getId(), 'blog::entry.full-'.$blog->getId(), 'blog::entry.full'])
@endsection
