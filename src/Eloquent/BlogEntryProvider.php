<?php

namespace Bjuppa\LaravelBlog\Eloquent;

use Bjuppa\LaravelBlog\Contracts\BlogEntry;
use Bjuppa\LaravelBlog\Contracts\BlogEntryProvider as BlogEntryProviderContract;
use Bjuppa\LaravelBlog\Eloquent\AbstractBlogEntry as EloquentBlogEntry;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class BlogEntryProvider implements BlogEntryProviderContract
{
    /**
     * @var EloquentBlogEntry
     */
    protected $model;

    /**
     * Blog id for the current blog
     * @var string
     */
    protected $blog_id;

    public function __construct(EloquentBlogEntry $model)
    {
        $this->withEntryModel($model);
    }

    /**
     * Set the entry model for the blog
     * @param string $blog_id
     * @return $this
     */
    public function withEntryModel(EloquentBlogEntry $model): BlogEntryProviderContract
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Set the id of the blog to use
     * @param string $blog_id
     * @return $this
     */
    public function withBlogId(string $blog_id): BlogEntryProviderContract
    {
        $this->blog_id = $blog_id;

        return $this;
    }

    /**
     * Get an instance of the Eloquent model used
     * @return EloquentBlogEntry
     */
    public function getBlogEntryModel(): EloquentBlogEntry
    {
        return $this->model::make(['blog' => $this->blog_id]);
    }

    /**
     * Get the classname of the Eloquent model used
     * @return string
     */
    public function getBlogEntryClass(): string
    {
        return get_class($this->model);
    }

    /**
     * Get a prepared query builder for the blog
     * @return Builder
     */
    public function getBuilder(): Builder
    {
        return $this->getBlogEntryModel()->blog($this->blog_id);
    }

    /**
     * Get a blog entry from a slug
     * @param string $slug
     * @return BlogEntry|null
     */
    public function findBySlug($slug): ?BlogEntry
    {
        return $this->getBuilder()->slug($slug)->first();
    }

    /**
     * Get the next entry within this blog
     * @param BlogEntry|null $entry
     * @return BlogEntry|null
     */
    public function nextEntry(BlogEntry $entry): ?BlogEntry
    {
        return $this->getBuilder()->publishedAfterEntry($entry)->first();
    }

    /**
     * Get the previous entry within this blog
     * @param BlogEntry|null $entry
     * @return BlogEntry|null
     */
    public function previousEntry(BlogEntry $entry): ?BlogEntry
    {
        return $this->getBuilder()->publishedBeforeEntry($entry)->first();
    }

    /**
     * Get the newest entries of the blog
     * @param int $limit
     * @return Collection
     */
    public function latest($limit = 5): Collection
    {
        return $this->getBuilder()->limit($limit)->get();
    }

    /**
     * Get the last updated timestamp for the entire blog
     * @return Carbon
     */
    public function getUpdated(): Carbon
    {
        return Carbon::parse($this->getBuilder()->max($this->getBlogEntryModel()::PUBLISH_AFTER))
            ->max($this->getBuilder()->max($this->getBlogEntryModel()::UPDATED_AT));
    }
}
