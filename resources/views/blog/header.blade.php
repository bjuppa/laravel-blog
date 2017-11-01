<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 */
?>
<header>
  {{-- TODO: wrap this in a blade section blogHeader --}}
  <h1>{{ $blog->getTitle() }}</h1>
  @includeFirst(['blog::blog.intro-'.$blog->getId(), 'blog::blog.intro'])
</header>
