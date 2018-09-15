@section('entryAsideAds')
  <aside class="blog-related-content grid-row-span-3">
    <header>
      <small>{{ __($blog->transKey('titles.ads')) }}</small>
    </header>
    <div>
      This blog is powered by<br>
      <a href="https://packagist.org/packages/bjuppa/laravel-blog" target="_blank" rel="noopener"><code>bjuppa/laravel-blog</code></a><br>
      created by Björn Nilsved
    </div>
  </aside>
@show
