@extends('blog::layouts.blog')

<?php
/**
 * @var $entries \Illuminate\Support\Collection
 */
?>

@push('meta')
  @include('blog::feed.meta_link')
@endpush

@section('blog')
  @if($entries->count())
    <ul>
      @each('blog::entry.list_item', $entries, 'entry')
    </ul>
  @endif
@endsection
