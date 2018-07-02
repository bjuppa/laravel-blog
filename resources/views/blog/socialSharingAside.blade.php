<aside class="blog-social-sharing">
@section('socialSharing')
  <?php
    $share_url = $share_url ?? url()->full();
    $share_title = $share_title ?? $__env->yieldContent('title');
  ?>
  <h2>{{ trans($blog->transKey('sharing.section_heading')) }}</h2>
  <ul title="{{ trans($blog->transKey('sharing.link_list_title')) }}">
    @includeFirst($blog->bladeViews('blog.partials.socialSharingListItem'), ['service_name' => 'Pinterest', 'href' => 'http://pinterest.com/pin/create/link/?' . http_build_query([ 'url' => $share_url ])])
    @includeFirst($blog->bladeViews('blog.partials.socialSharingListItem'), ['service_name' => 'Facebook', 'href' => 'https://www.facebook.com/sharer.php?' . http_build_query([ 'u' => $share_url ])])
    @includeFirst($blog->bladeViews('blog.partials.socialSharingListItem'), ['service_name' => 'LinkedIn', 'href' => 'https://www.linkedin.com/shareArticle?' . http_build_query([ 'mini' => 'true', 'url' => $share_url, 'title' => $share_title ])])
    @includeFirst($blog->bladeViews('blog.partials.socialSharingListItem'), ['service_name' => 'Twitter', 'href' => 'https://twitter.com/intent/tweet?' . http_build_query([ 'url' => $share_url ])])
    @includeFirst($blog->bladeViews('blog.partials.socialSharingListItem'), ['service_name' => 'Google+', 'href' => 'https://plus.google.com/share?' . http_build_query([ 'url' => $share_url ])])
    @includeFirst($blog->bladeViews('blog.partials.socialSharingListItem'), ['service_name' => 'Tumblr', 'href' => 'https://www.tumblr.com/widgets/share/tool?' . http_build_query([ 'canonicalUrl' => $share_url, 'title' => $share_title ])])
    @includeFirst($blog->bladeViews('blog.partials.socialSharingListItem'), ['service_name' => 'Reddit', 'href' => 'https://reddit.com/submit?' . http_build_query([ 'url' => $share_url, 'title' => $share_title ])])
    @includeFirst($blog->bladeViews('blog.partials.socialSharingListItem'), ['service_name' => 'Digg', 'href' => 'http://digg.com/submit?' . http_build_query([ 'url' => $share_url ])])
  </ul>
@show
</aside>
