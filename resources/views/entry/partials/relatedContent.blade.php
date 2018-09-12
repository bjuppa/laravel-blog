@section('blogRelatedContent')
  <aside class="blog-related-content grid-row-span-6">
    @includeFirst($blog->bladeViews('blog.latestEntriesLinks'))
  </aside>
  @includeFirst($blog->bladeViews('entry.partials.asideAds'))
@show
