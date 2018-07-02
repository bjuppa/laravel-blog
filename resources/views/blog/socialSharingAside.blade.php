<aside class="blog-social-sharing">
@section('socialSharing')
  <?php
    $share_url = $share_url ?? url()->full();
  ?>
  <ul title="{{ trans($blog->transKey('titles.share_this')) }}">
    @includeFirst($blog->bladeViews('blog.partials.socialSharingListItem'), ['service_name' => 'Facebook', 'href' => 'https://www.facebook.com/sharer.php?' . http_build_query(['u' => $share_url ])])
  </ul>
@show
</aside>
