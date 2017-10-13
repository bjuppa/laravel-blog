<?php

namespace Bjuppa\LaravelBlog\Eloquent;

use Bjuppa\LaravelBlog\Contracts\BlogEntry;
use Bjuppa\LaravelBlog\Contracts\BlogEntryProvider as BlogEntryProviderContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BlogEntryProvider implements BlogEntryProviderContract
{
    protected $model = \Bjuppa\LaravelBlog\Eloquent\BlogEntry::class;

    /**
     * Blog id for the current blog
     * @var string
     */
    protected $blog_id;

    /**
     * BlogEntryProvider constructor.
     * @param string $blog_id
     */
    public function __construct(string $blog_id)
    {
        $this->blog_id = $blog_id;
    }

    /**
     * Get an instance of the Eloquent model used
     * @return Model
     */
    protected function getBlogModel(): Model
    {
        return new $this->model;
    }

    /**
     * Get a prepared query builder for the blog
     * @return Builder
     */
    protected function getBuilder(): Builder
    {
        return $this->getBlogModel()->blog($this->blog_id);
    }

    /**
     * Get a blog entry from a slug
     * @param $slug
     * @return BlogEntry|null
     */
    public function findBySlug($slug): ?BlogEntry
    {
        return $this->getBuilder()->where('slug', $slug)->first();
    }

    /**
     * Get the newest entries of the blog
     * @param int $limit
     * @return Collection
     */
    public function latest($limit = 5): Collection
    {
        return $this->getBuilder()->latest()->limit($limit)->get();
    }
}
