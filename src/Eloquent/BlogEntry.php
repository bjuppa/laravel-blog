<?php

namespace Bjuppa\LaravelBlog\Eloquent;

use Bjuppa\LaravelBlog\Support\Author;
use Bjuppa\LaravelBlog\Support\MarkdownString;
use Bjuppa\LaravelBlog\Support\SummaryExtractor;
use Bjuppa\MetaTagBag\MetaTagBag;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Htmlable;
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
 * @property bool display_full_content_in_feed
 */
class BlogEntry extends AbstractBlogEntry
{
    use HasSlug;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['publish_after'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta_tags' => 'array',
    ];

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
        return static::SLUG;
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
        return $this->getAttribute($this->getRouteKeyName());
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
            return new HtmlString('<p><img src="' . e($this->image) . '" alt=""></p>');
        }

        return new MarkdownString($this->image);
    }

    /**
     * Url for the entry's main image (if applicable)
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        if (starts_with($this->image, ['http://', 'https://', '//'])) {
            return $this->image;
        }

        // Match quotes or opening parenthesis with matching end
        // Within that, capture http:// or https:// or just // and all following non-space characters into subpattern 3
        if (preg_match('/((\'|")|\()((https?:)?\/\/\S+).*(?(2)\2|\))/s', $this->image, $matches)) {
            return $matches[3];
        }

        return null;
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
        return $this->getAttribute(static::PUBLISH_AFTER) and (new Carbon($this->getAttribute(static::PUBLISH_AFTER)))->isPast();
    }

    /**
     * Get the meta-description for this entry
     * @return string|null
     */
    public function getMetaDescription(): ?string
    {
        return trim($this->description);
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
     * Get any custom meta-tag attributes for this entry
     * @return MetaTagBag
     */
    public function getMetaTagBag(): MetaTagBag
    {
        return MetaTagBag::make(
            ['property' => 'og:title', 'content' => $this->getTitle()],
            ['property' => 'og:type', 'content' => 'article'],
            ['property' => 'article:published_time', 'content' => $this->getPublished()->toIso8601String()],
            ['property' => 'article:modified_time', 'content' => $this->getUpdated()->toIso8601String()]
        )
            ->pipe(function ($bag) {
                if ($this->getMetaDescription()) {
                    $bag->merge(['name' => 'description', 'content' => $this->getMetaDescription()]);
                }

                if ($this->getImageUrl()) {
                    $bag->merge(
                        ['name' => 'twitter:card', 'content' => 'summary_large_image'],
                        ['name' => 'twitter:image', 'content' => $this->getImageUrl()]
                    );

                }

                return $bag;
            })
            ->merge($this->meta_tags);
    }

    /**
     * Check if complete entry contents should be made available in feed
     * @param bool $default
     * @return bool
     */
    public function displayFullContentInFeed(bool $default = false): bool
    {
        return $this->display_full_content_in_feed ?? $default;
    }
}
