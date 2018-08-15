<?php

namespace Bjuppa\LaravelBlog\Eloquent;

use Bjuppa\LaravelBlog\Contracts\BlogEntry as BlogEntryContract;
use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class AbstractBlogEntry extends Eloquent implements BlogEntryContract
{
    /**
     * The name of the "publish after" column.
     *
     * @var string
     */
    const PUBLISH_AFTER = 'publish_after';

    /**
     * The name of the "slug" column.
     *
     * @var string
     */
    const SLUG = 'slug';

    /**
     * The name of the "blog" column.
     *
     * @var string
     */
    const BLOG = 'blog';

    //TODO: make these abstract methods and move implementations back to BlogEntry or into traits
    /**
     * Scope a query to entries for one specific blog
     * @param $query
     * @param $blog_id
     * @return mixed
     */
    public function scopeBlog($query, $blog_id)
    {
        return $query->where(static::BLOG, $blog_id);
    }

    /**
     * Scope a query to entries matching slug
     * @param $query
     * @param string $slug
     * @return mixed
     */
    public function scopeSlug($query, $slug)
    {
        return $query->where(static::SLUG, $slug);
    }

    /**
     * Order query results with oldest publication first
     * @param $query
     * @return mixed
     */
    public function scopeOldestPublication($query)
    {
        return $query->oldest(static::PUBLISH_AFTER)->orderBy($this->getKeyName());
    }

    /**
     * Order query results with latest publication first
     * @param $query
     * @return mixed
     */
    public function scopeLatestPublication($query)
    {
        return $query->latest(static::PUBLISH_AFTER)->orderByDesc($this->getKeyName());
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
        return $query->where(static::PUBLISH_AFTER, '>=', $entry->getPublished())->where($this->getKeyName(), '>', $entry->getKey())->oldestPublication();
    }

    /**
     * Scope a query to entries published before another entry
     * @param $query
     * @param AbstractBlogEntry $entry
     * @return mixed
     */
    public function scopePublishedBefore($query, AbstractBlogEntry $entry)
    {
        return $query->where(static::PUBLISH_AFTER, '<=', $entry->getPublished())->where($this->getKeyName(), '<', $entry->getKey())->latestPublication();
    }
}
