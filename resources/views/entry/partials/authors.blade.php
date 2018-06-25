<?php
/**
 * @var $authors \Illuminate\Support\Collection
 * @var $author \Bjuppa\LaravelBlog\Contracts\Author
 */
?>
{{-- TODO: set title="Authors" on the list --}}
<ul class="blog-author-list list-inline">
  @foreach($authors as $author)
    @includeFirst($blog->bladeViews('author.listItem'))
  @endforeach
</ul>
