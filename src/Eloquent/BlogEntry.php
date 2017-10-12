<?php

namespace Bjuppa\LaravelBlog\Eloquent;

use Bjuppa\LaravelBlog\Contracts\BlogEntry as BlogEntryContract;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * @property string slug
 * @property string headline
 */
class BlogEntry extends Eloquent implements BlogEntryContract
{
    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        if (!isset($this->table)) {
            //TODO: Should the entry model's table name come from a config file specific to the eloquent blog entries?
            return config('blog.eloquent_entries_table', 'blog_entries');
        }

        return $this->table;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the entry's unique slug for urls
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Get the entry's headline
     * @return string
     */
    public function getHeadline(): string
    {
        return $this->headline;
    }
}
