<?php
/**
 * @var $author \Bjuppa\LaravelBlog\Contracts\Author
 */
?>
<author>
  <name><![CDATA[{{ $author->getName() }}]]></name>
  @if($author->getEmail())
    <email>{{ $author->getEmail() }}</email>
  @endif
  @if($author->getUrl())
    <uri>{{ $author->getUrl() }}</uri>
  @endif
</author>
