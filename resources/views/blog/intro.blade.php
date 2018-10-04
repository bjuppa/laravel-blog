@if($blog->getDescription())
  <p class="blog-description" itemprop="description">{{ $blog->getDescription() }}</p>
@endif
