<?php

namespace Bjuppa\LaravelBlog\Contracts;

interface EloquentBlogEntry extends BlogEntry
{
    /**
     * Scope a query to entries for one specific blog
     * @param $query
     * @param $blog_id
     * @return mixed
     */
    public function scopeBlog($query, $blog_id);

    /**
     * Scope a query to entries matching slug
     * @param $query
     * @param string $slug
     * @return mixed
     */
    public function scopeSlug($query, $slug);
}
