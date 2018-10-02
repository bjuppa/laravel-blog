@section('entryAsideAds')
  <aside class="blog-related-content grid-row-span-4">
    <header>
      <small>{{ __($blog->transKey('titles.ads')) }}</small>
    </header>
    <section>
      This blog is powered by<br>
      <a href="https://packagist.org/packages/bjuppa/laravel-blog" target="_blank" rel="noopener"><code>bjuppa/laravel-blog</code></a><br>
      created by Björn Nilsved
    </section>
    <section>
      <p>Oppose fascism, support democracy!</p>
      <p>Vote if you're allowed to where you live; and vote carefully!</p>
    </section>
  </aside>
@show
