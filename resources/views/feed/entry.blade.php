<?php
/**
 * @var $blog \Bjuppa\LaravelBlog\Contracts\Blog
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
<entry>
  <title><![CDATA[{{ $entry->getTitle() }}]]></title>
  <link rel="alternate" href="{{ $blog->urlToEntry($entry) }}"/>
  <id>{{ url($blog->getId(), $entry->getId()) }}</id>
  @each('blog::feed.author', $entry->getAuthors(), 'author')
  <summary type="html">
    <![CDATA[{{ $entry->getSummary() }}]]>
  </summary>
  <updated>{{ $entry->getUpdated()->toAtomString() }}</updated>
</entry>
