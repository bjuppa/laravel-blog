@extends('blog::layouts.blog')

@section('blog')
  <h1>{{ $entry->getHeadline() }}</h1>
@endsection
