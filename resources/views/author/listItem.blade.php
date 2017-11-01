<?php
/**
 * @var $author \Bjuppa\LaravelBlog\Contracts\Author
 */
?>
<li>
  @if($author->getHref())
    <address><a href="{{ $author->getHref() }}" rel="author">{{ $author->getName() }}</a></address>
  @else
    {{ $author->getName() }}
  @endif
</li>
