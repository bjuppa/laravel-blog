<?php
/**
 * @var $author \Bjuppa\LaravelBlog\Contracts\Author
 */
?>
@foreach($authors as $author)
  @if($author->getHref())
    <address><a href="{{ $author->getHref() }}">{{ $author->getName() }}</a></address>
  @else
    {{ $author->getName() }}
  @endif
@endforeach
