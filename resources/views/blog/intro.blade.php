<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 */
?>
<div class="blog-intro">
  @section('blogIntro')
    <header>
      @section('blogHeader')
        <h1 class="blog-title" itemprop="name">{{ $blog->getTitle() }}</h1>
        @if($blog->getDescription())
          <p class="blog-description" itemprop="description">{{ $blog->getDescription() }}</p>
        @endif
      @show
    </header>
    <footer>
      @section('blogFooter')
        @includeFirst($blog->bladeViews('feed.subscriptionLink'))
      @show
    </footer>
  @show
</div>
