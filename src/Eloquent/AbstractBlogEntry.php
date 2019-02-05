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
        return Carbon::parse($this->getAttributeFromArray(static::UPDATED_AT))->max($this->getPublished())->copy();
    }

    /**
     * Get the timestamp of the original publication of the entry
     * @return Carbon
     */
    public function getPublished(): Carbon
    {
        return Carbon::parse(
            $this->getAttributeFromArray(static::PUBLISH_AFTER) ?: $this->getAttributeFromArray(static::CREATED_AT)
        );
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
        return $this->getAttributeFromArray(static::PUBLISH_AFTER) and
        Carbon::parse($this->getAttributeFromArray(static::PUBLISH_AFTER))->isPast();
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

    public function getBlogId()
    {
        return $this->getAttribute(static::BLOG);
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
        return $query->oldest(static::PUBLISH_AFTER)
            ->orderBy($this->getKeyName());
    }

    /**
     * Order query results with latest publication first
     * @param $query
     * @return mixed
     */
    public function scopeLatestPublication($query)
    {
        return $query->orderByRaw(static::PUBLISH_AFTER . ' IS NOT NULL')
            ->latest(static::PUBLISH_AFTER)
            ->orderByDesc($this->getKeyName());
    }

    /**
     * Scope a query to entries published after another entry
     * @param $query
     * @param AbstractBlogEntry $entry
     * @return mixed
     */
    public function scopePublishedAfterEntry($query, AbstractBlogEntry $entry)
    {
        return $query->publishedRelativeEntry($entry, '>')->oldestPublication();
    }

    /**
     * Scope a query to entries published before another entry
     * @param $query
     * @param AbstractBlogEntry $entry
     * @return mixed
     */
    public function scopePublishedBeforeEntry($query, AbstractBlogEntry $entry)
    {
        return $query->publishedRelativeEntry($entry, '<')->latestPublication();
    }

    /**
     * Scope a query to entries published before or after another entry
     * @param $query
     * @param AbstractBlogEntry $entry
     * @return mixed
     */
    public function scopePublishedRelativeEntry($query, AbstractBlogEntry $entry, string $operator = '>')
    {
        return $query->where(function ($query) use ($entry, $operator) {
            $query->where(static::PUBLISH_AFTER, $operator, $entry->getPublished())
                ->orWhere(function ($query) use ($entry, $operator) {
                    $query->where(static::PUBLISH_AFTER, '=', $entry->getPublished())
                        ->where($this->getKeyName(), $operator, $entry->getKey());
                });
        });
    }
}
