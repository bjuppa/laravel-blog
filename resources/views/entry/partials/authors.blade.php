<?php
/**
 * @var $authors \Illuminate\Support\Collection
 * @var $author \Bjuppa\LaravelBlog\Contracts\Author
 */
?>
<ul>
  @foreach($authors as $author)
    <li>
      @if($author->getHref())
        <address><a href="{{ $author->getHref() }}" rel="author">{{ $author->getName() }}</a></address>
      @else
        {{ $author->getName() }}
      @endif
    </li>
  @endforeach
</ul>
