{{-- TODO: pull meta description from the meta tag bag --}}
@if($blog->getMetaDescription())
  <p class="blog-description">{{ $blog->getMetaDescription() }}</p>
@endif
