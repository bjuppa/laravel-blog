<?php

namespace Bjuppa\LaravelBlog\Eloquent;

use Bjuppa\LaravelBlog\Contracts\BlogEntry as BlogEntryContract;
use Carbon\Carbon;
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

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return static::SLUG;
    }

    /**
     * Get the entry's unique slug for urls
     * @return string
     */
    public function getSlug(): string
    {
        return $this->getAttribute($this->getRouteKeyName());
    }

    /**
     * Get the timestamp for last update to entry
     * @return Carbon
     */
    public function getUpdated(): Carbon
    {
        return (new Carbon($this->getAttribute(static::UPDATED_AT)))->max($this->getPublished())->copy();
    }

    /**
     * Get the timestamp of the original publication of the entry
     * @return Carbon
     */
    public function getPublished(): Carbon
    {
        return new Carbon($this->getAttribute(static::PUBLISH_AFTER) ?: $this->getAttribute(static::CREATED_AT));
    }

    /**
     * Get a unique id for this blog entry within the blog
     * @return string
     */
    public function getId(): string
    {
        return $this->getKey();
    }

    /**
     * Check if the entry is public
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->getAttribute(static::PUBLISH_AFTER) and (new Carbon($this->getAttribute(static::PUBLISH_AFTER)))->isPast();
    }

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
        //TODO: allow parameter to be a Carbon instance too
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
