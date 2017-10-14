<?php

namespace Bjuppa\LaravelBlog\Tests\Feature\Fakes;

use Bjuppa\LaravelBlog\Contracts\BlogEntry;
use Illuminate\Support\Collection;

class BlogEntryProvider implements \Bjuppa\LaravelBlog\Contracts\BlogEntryProvider
{

    /**
     * BlogEntryProvider constructor.
     * @param string $blog_id
     */
    public function __construct(string $blog_id)
    {

    }

    /**
     * Get a blog entry from a slug
     * @param $slug
     * @return BlogEntry|null
     */
    public function findBySlug($slug): ?BlogEntry
    {
        return null;
    }

    /**
     * Get the newest entries of the blog
     * @param int $limit
     * @return Collection
     */
    public function latest($limit = 5): Collection
    {
        return new Collection();
    }
}
