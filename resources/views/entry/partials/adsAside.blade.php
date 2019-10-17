@section('entryAsideAds')
  <aside class="blog-related-content children:boxed pb-1 grid-row-span-4">
    <header>
      <small>{{ __($blog->transKey('titles.ads')) }}</small>
    </header>
    <section lang="en" dir="ltr" style="font-family: Arial Narrow,sans-serif;">
      This blog is powered by
      <a href="https://packagist.org/packages/bjuppa/laravel-blog" target="_blank" rel="noopener"><code>bjuppa/laravel-blog</code></a>
      created by Björn Nilsved
    </section>
    <section lang="en" dir="ltr" style="font-family: Georgia,Times,Times New Roman,serif;" class="p-1">
      <p>
        Oppose fascism,<br>
        support democracy!
      </p>
      <p>
        Vote if you’re allowed to;<br>
        and please vote carefully!
      </p>
    </section>
  </aside>
@show
