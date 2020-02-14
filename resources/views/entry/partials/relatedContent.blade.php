@section('blogRelatedContent')
  <aside class="blog-latest-entries safari-reader-mode-hide-links">
    <header aria-hidden="true">
      <small>{{ __($blog->transKey('titles.latest_entries')) }}</small>
    </header>
    @includeFirst($blog->bladeViews('blog.latestEntriesLinks'))
    <div class="blog-feed-subscriptions">
      @includeFirst($blog->bladeViews('feed.subscriptionLink'))
    </div>
  </aside>
@show
