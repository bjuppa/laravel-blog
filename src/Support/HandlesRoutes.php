<?php

namespace Bjuppa\LaravelBlog\Support;

use Bjuppa\LaravelBlog\Contracts\BlogEntry;

trait HandlesRoutes
{
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

    /**
     * Get the full public url to the blog's index page
     * @return string
     */
    public function urlToIndex(): string
    {
        return route($this->prefixRouteName('index'));
    }

    /**
     * Get the full public url to a single entry within this blog
     * @param BlogEntry $entry
     * @return string
     */
    public function urlToEntry(BlogEntry $entry): string
    {
        return route($this->prefixRouteName('entry'), $entry->getSlug());
    }

    /**
     * Get the full public url to the blog's atom feed
     * @return string
     */
    public function urlToFeed(): string
    {
        return route($this->prefixRouteName('feed'));
    }
}
