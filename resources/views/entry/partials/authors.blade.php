<?php
/**
 * @var $authors \Illuminate\Support\Collection
 * @var $author \Bjuppa\LaravelBlog\Contracts\Author
 */
?>
{{-- TODO: set title="authors" on the list --}}
<ul>
  @foreach($authors as $author)
    @include('blog::author.listItem')
  @endforeach
</ul>
