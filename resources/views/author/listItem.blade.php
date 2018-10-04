<?php
/**
 * @var $author \Bjuppa\LaravelBlog\Contracts\Author
 */
?>
<li class="blog-author" itemprop="author">
  @if($author->getHref())
    <address><a href="{{ $author->getHref() }}" rel="author">{{ $author->getName() }}</a></address>
  @else
    {{ $author->getName() }}
  @endif
</li>
