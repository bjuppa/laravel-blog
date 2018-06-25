<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 */
?>
<header class="blog-index-header">
  @section('blogHeader')
    <h1 class="blog-title">{{ $blog->getTitle() }}</h1>
    @includeFirst($blog->bladeViews('intro'))
  @show
</header>
