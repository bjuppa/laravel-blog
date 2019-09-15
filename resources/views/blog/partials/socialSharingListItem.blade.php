<li class="share-on-{{ Illuminate\Support\Str::kebab(strip_tags($service_name)) }}">
  @includeFirst($blog->bladeViews('blog.partials.socialSharingLink'))
</li>
