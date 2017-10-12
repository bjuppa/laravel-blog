<?php

namespace Bjuppa\LaravelBlog\Contracts;

interface BlogEntryProvider
{
    /**
     * BlogEntryProvider constructor.
     * @param string $blog_id
     */
    public function __construct(string $blog_id);

    /**
     * Get a blog entry from a slug
     * @param $slug
     * @return BlogEntry|null
     */
    public function findBySlug($slug): ?BlogEntry;
}
