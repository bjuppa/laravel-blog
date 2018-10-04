<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 */
?>
<header class="blog-index-header">
  @section('blogHeader')
    <h1 class="blog-title" itemprop="name">{{ $blog->getTitle() }}</h1>
    @includeFirst($blog->bladeViews('blog.intro'))
  @show
</header>
