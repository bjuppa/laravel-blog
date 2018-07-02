<aside class="blog-social-sharing">
@section('socialSharing')
  <?php
    $share_url = $share_url ?? url()->full();
  ?>
  <h2>{{ trans($blog->transKey('sharing.section_heading')) }}</h2>
  <ul title="{{ trans($blog->transKey('sharing.link_list_title')) }}">
    @includeFirst($blog->bladeViews('blog.partials.socialSharingListItem'), ['service_name' => 'Facebook', 'href' => 'https://www.facebook.com/sharer.php?' . http_build_query(['u' => $share_url ])])
    @includeFirst($blog->bladeViews('blog.partials.socialSharingListItem'), ['service_name' => 'Twitter', 'href' => 'https://twitter.com/intent/tweet?' . http_build_query(['url' => $share_url ])])
    @includeFirst($blog->bladeViews('blog.partials.socialSharingListItem'), ['service_name' => 'LinkedIn', 'href' => 'https://www.linkedin.com/shareArticle?' . http_build_query(['mini' => 'true', 'url' => $share_url ])])
    @includeFirst($blog->bladeViews('blog.partials.socialSharingListItem'), ['service_name' => 'Google+', 'href' => 'https://plus.google.com/share?' . http_build_query(['url' => $share_url ])])
    @includeFirst($blog->bladeViews('blog.partials.socialSharingListItem'), ['service_name' => 'Pinterest', 'href' => 'http://pinterest.com/pin/create/link/?' . http_build_query(['url' => $share_url ])])
  </ul>
@show
</aside>
