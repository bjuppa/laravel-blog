<?php

namespace Bjuppa\LaravelBlog\Support;

trait PrefixesRouteNames {
    /**
     * Prefix a route name for this blog
     *
     * @param string $name If empty, only the prefix is returned
     * @return string
     */
    public function prefixRouteName(string $name = ''): string
    {
        return implode('.', [config('blog.route_name_prefix', 'blog'), $this->getId(), $name]);
    }

}
