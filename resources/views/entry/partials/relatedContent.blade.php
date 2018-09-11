@section('blogRelatedContent')
  <aside class="blog-related-content">
    @includeFirst($blog->bladeViews('blog.latestEntriesLinks'))
  </aside>
  @includeFirst($blog->bladeViews('entry.partials.asideAds'))
@show
