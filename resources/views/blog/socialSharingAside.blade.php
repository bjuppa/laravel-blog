<aside class="blog-social-sharing">
@section('socialSharing')
  <?php
    $share_url = $share_url ?? url()->full();
  ?>
  <ul title="{{ trans($blog->transKey('titles.share_this')) }}">
    <li class="share-on-facebook">
      <a href="https://www.facebook.com/sharer.php?{{ http_build_query(['u' => $share_url ]) }}" target="_blank" rel="noopener"><span>Share this page on </span><span>Facebook</span></a>
    </li>
  </ul>
@show
</aside>
