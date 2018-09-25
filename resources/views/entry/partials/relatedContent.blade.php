@section('blogRelatedContent')
  <aside class="blog-latest-entries">
    @includeFirst($blog->bladeViews('blog.latestEntriesLinks'))
  </aside>
@show
