<?php

namespace Bjuppa\LaravelBlog\Eloquent;

use Bjuppa\LaravelBlog\Contracts\BlogEntry as BlogEntryContract;
use Bjuppa\LaravelBlog\Contracts\Blog;
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
 * @property Carbon publish_after
 * @property string author_name
 * @property string author_email
 * @property string author_url
 * @property string image
 * @property string summary
 * @property string description
 */
class BlogEntry extends Eloquent implements BlogEntryContract
{
    use HasSlug;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['publish_after'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     * @throws \InvalidArgumentException
     */
    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope(new PublishedScope());
    }

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable(): string
    {
        if (!isset($this->table)) {
            return config('blog-eloquent.entries_table', 'blog_entries');
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
        $options = SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo($this->getRouteKeyName());

        if ($this->isPublic()) {
            $options->doNotGenerateSlugsOnUpdate();
        }

        return $options;
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
        return ($this->publish_after ?: $this->created_at)->copy();
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
            $authors->push(new Author([
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
        return $this->publish_after and $this->publish_after->isPast();
    }

    /**
     * Get the meta-description for this entry
     * @return string|null
     */
    public function getMetaDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Get the html head title for this entry
     * @param string $suffix to append after the title
     * @return string
     */
    public function getPageTitle(string $suffix = ''): string
    {
        return str_finish($this->page_title ?? $this->getTitle(), $suffix);
    }

    /**
     * Get an array of views in descending priority order
     * Suitable for Blade directive @includeFirst()
     * @param string $name
     * @param Blog $blog
     * @return array
     */
    public function bladeViews($name, Blog $blog = null): array
    {
        $base = 'blog::entry.' . $name;
        $views = [
            $base . '-' . $this->getId(),
            $base
        ];

        if($blog) {
            array_unshift($views, $base . '-' . $blog->getId() . '-' . $this->getId());
        }

        return $views;
    }
}
