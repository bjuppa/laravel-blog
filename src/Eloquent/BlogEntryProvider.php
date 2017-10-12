<?php

namespace Bjuppa\LaravelBlog\Eloquent;

use Bjuppa\LaravelBlog\Contracts\BlogEntry;
use Bjuppa\LaravelBlog\Contracts\BlogEntryProvider as BlogEntryProviderContract;
use Illuminate\Database\Eloquent\Model;

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
     * Return an instance of the Eloquent model used
     * @return Model
     */
    protected function getBlogModel(): Model
    {
        return new $this->model();
    }

    /**
     * Get a blog entry from a slug
     * @param $slug
     * @return BlogEntry|null
     */
    public function findBySlug($slug): ?BlogEntry
    {
        return $this->getBlogModel()::where(['blog' => $this->blog_id, 'slug' => $slug])->first();
    }
}
