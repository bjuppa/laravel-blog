<?=
/* Using an echo tag here so the `<? ... ?>` won't get parsed as short tags */
'<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL
?>
<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 */
?>
<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="{{ app()->getLocale() }}">
  <title><![CDATA[{{ $blog->getTitle() }}]]></title>
  <link rel="alternate" type="text/html" href="{{ $blog->urlToIndex() }}" />
  @each($blog->bladeView('feed.author'), $blog->getAuthors(), 'author')
  <link rel="self" href="{{ $blog->urlToFeed() }}" />
  <updated>{{ $blog->convertToBlogTimezone($blog->getUpdated())->toAtomString() }}</updated>
  <id>{{ url($blog->getId()) }}</id>
  @each($blog->bladeView('feed.entry'), $entries, 'entry')
</feed>
