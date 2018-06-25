<aside class="blog-related-content">
  @section('blogEntryAside')
    @includeFirst($blog->bladeViews('blog.latestEntriesLinks'))
    @includeFirst($blog->bladeViews('entry.partials.asideAds'))
  @show
</aside>
