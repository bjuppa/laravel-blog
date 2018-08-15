<?php

namespace Bjuppa\LaravelBlog\Eloquent;

use Bjuppa\LaravelBlog\Contracts\BlogEntry as BlogEntryContract;
use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class AbstractBlogEntry extends Eloquent implements BlogEntryContract
{
    /**
     * Scope a query to entries for one specific blog
     * @param $query
     * @param $blog_id
     * @return mixed
     */
    public function scopeBlog($query, $blog_id)
    {
        return $query->where('blog', $blog_id);
    }

    /**
     * Scope a query to entries matching slug
     * @param $query
     * @param string $slug
     * @return mixed
     */
    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    /**
     * Order query results with oldest publication first
     * @param $query
     * @return mixed
     */
    public function scopeOldestPublication($query)
    {
        return $query->oldest('publish_after')->orderBy($this->getKeyName());
    }

    /**
     * Order query results with latest publication first
     * @param $query
     * @return mixed
     */
    public function scopeLatestPublication($query)
    {
        return $query->latest('publish_after')->orderByDesc($this->getKeyName());
    }

    /**
     * Scope a query to entries published after another entry
     * @param $query
     * @param AbstractBlogEntry $entry
     * @return mixed
     */
    public function scopePublishedAfter($query, AbstractBlogEntry $entry)
    {
        //TODO: check if $entry is an eloquent model of the same type as this before comparing by keys
        //TODO: only compare keys if published_after equals
        return $query->where('publish_after', '>=', $entry->getPublished())->where($this->getKeyName(), '>', $entry->getKey())->oldestPublication();
    }

    /**
     * Scope a query to entries published before another entry
     * @param $query
     * @param AbstractBlogEntry $entry
     * @return mixed
     */
    public function scopePublishedBefore($query, AbstractBlogEntry $entry)
    {
        return $query->where('publish_after', '<=', $entry->getPublished())->where($this->getKeyName(), '<', $entry->getKey())->latestPublication();
    }
}
