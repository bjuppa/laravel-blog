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
  @each($blog->bladeView('feed.author'), $entry->getAuthors(), 'author')
  <summary type="html">
    <![CDATA[{{ $entry->getSummary() }}]]>
    <![CDATA[@include($blog->bladeView('feed.summaryFooter'))]]>
  </summary>
  @if($blog->displayFullEntryInFeed($entry))
  <content type="html">
    <![CDATA[{{ $entry->getContent() }}]]>
  </content>
  @endif
  <published>{{ $blog->convertToBlogTimezone($entry->getPublished())->toAtomString() }}</published>
  <updated>{{ $blog->convertToBlogTimezone($entry->getUpdated())->toAtomString() }}</updated>
</entry>
