<li class="share-on-{{ kebab_case(strip_tags($service_name)) }}">
  <a href="{{ $href }}" target="_blank" rel="noopener"><span class="share-link-prefix">{{ trans($blog->transKey('sharing.link_prefix')) }}</span><span class="share-link-service">{!! $service_name !!}</span></a>
</li>
