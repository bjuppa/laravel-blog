<?php
/**
 * @var $authors \Illuminate\Support\Collection
 * @var $author \Bjuppa\LaravelBlog\Contracts\Author
 */
?>
<ul class="blog-author-list" aria-label="{{ __($blog->transKey('titles.authors')) }}">
  @foreach($authors as $author)
    @includeFirst($blog->bladeViews('author.listItem'))
  @endforeach
</ul>
