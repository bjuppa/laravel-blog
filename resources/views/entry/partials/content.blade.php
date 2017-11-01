<?php
/**
 * @var $entry \Bjuppa\LaravelBlog\Contracts\BlogEntry
 */
?>
{{-- TODO: consider adding a wrapping element around the entry content --}}
<hr class="blog-content-start">
{{ $entry->getContent() }}
<hr class="blog-content-end">
