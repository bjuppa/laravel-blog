<?php

namespace Bjuppa\LaravelBlog\Eloquent;

use Bjuppa\LaravelBlog\Contracts\BlogEntry as BlogEntryContract;
use Bjuppa\LaravelBlog\Support\Author;
use Bjuppa\LaravelBlog\Support\MarkdownString;
use Bjuppa\LaravelBlog\Support\SummaryExtractor;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property string slug
 * @property string title
 * @property string content
 * @property Carbon updated_at
 * @property Carbon created_at
 * @property string author_name
 * @property string author_email
 * @property string author_url
 * @property string image
 * @property string summary
 */
class BlogEntry extends Eloquent implements BlogEntryContract
{
    use HasSlug;

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
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        //TODO: allow slug to be auto-updated up until the blog post has been published
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo($this->getRouteKeyName())
            ->doNotGenerateSlugsOnUpdate();
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
    public function getTitle(): string
    {
        return $this->title;
    }

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
     * Get the entry's full body text with markup
     * @return Htmlable
     */
    public function getContent(): Htmlable
    {
        return new MarkdownString($this->content);
    }

    /**
     * Get the timestamp for last update to entry
     * @return Carbon
     */
    public function getUpdated(): Carbon
    {
        return $this->updated_at->max($this->getPublished())->copy();
    }

    /**
     * Get the timestamp of the original publication of the entry
     * @return Carbon
     */
    public function getPublished(): Carbon
    {
        return $this->created_at->copy();
    }

    /**
     * The entry's authors
     * An empty collection indicates the entry should be considered written by the blog's default author
     * @return Collection
     */
    public function getAuthors(): Collection
    {
        $authors = collect();
        if ($this->author_name) {
            $authors->add(new Author([
                'name' => $this->author_name,
                'email' => $this->author_email,
                'url' => $this->author_url,
            ]));
        }
        return $authors;
    }

    /**
     * The entry's main image (if applicable), tagged in html
     * @return Htmlable|null
     */
    public function getImage(): ?Htmlable
    {
        if (empty($this->image)) {
            return null;
        }

        if (starts_with($this->image, ['http://', 'https://', '//'])) {
            return new HtmlString('<p><img src="' . e($this->image) . '"></p>');
        }

        return new MarkdownString($this->image);
    }

    /**
     * Get the entry's summary with markup
     * @return Htmlable
     */
    public function getSummary(): Htmlable
    {
        if (!empty(trim($this->summary))) {
            return new MarkdownString($this->summary);
        }

        $paragraphs = SummaryExtractor::splitParagraphs($this->getContent())->split(3)->first();
        $paragraphs = SummaryExtractor::takeWithCharacterThreshold($paragraphs);
        $paragraphs->push(SummaryExtractor::truncateParagraph($paragraphs->pop()));

        return new HtmlString($paragraphs->implode("\n"));
    }
}
