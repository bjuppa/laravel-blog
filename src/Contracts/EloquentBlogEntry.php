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

    /**
     * Order query results with oldest publication first
     * @param $query
     * @return mixed
     */
    public function scopeOldestPublication($query);

    /**
     * Order query results with latest publication first
     * @param $query
     * @return mixed
     */
    public function scopeLatestPublication($query);

    /**
     * Scope a query to entries published after another entry
     * @param $query
     * @param BlogEntry $entry
     * @return mixed
     */
    public function scopePublishedAfter($query, BlogEntry $entry);

    /**
     * Scope a query to entries published before another entry
     * @param $query
     * @param BlogEntry $entry
     * @return mixed
     */
    public function scopePublishedBefore($query, BlogEntry $entry);
}
