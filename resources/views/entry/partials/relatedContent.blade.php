@section('blogRelatedContent')
  <aside class="blog-latest-entries">
    <header>
      <small>{{ __($blog->transKey('titles.latest_entries')) }}</small>
    </header>
    @includeFirst($blog->bladeViews('blog.latestEntriesLinks'))
  </aside>
@show
