<?php

namespace Bjuppa\LaravelBlog\Contracts;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;
use Bjuppa\MetaTagBag\Contracts\MetaTagProvider;

interface BlogEntry extends MetaTagProvider
{
    /**
     * Get the entry's unique slug for urls
     * @return string
     */
    public function getSlug(): string;

    /**
     * Get the entry's headline
     * @return string
     */
    public function getTitle(): string;

    /**
     * Get the entry's full body text with markup
     * @return Htmlable
     */
    public function getContent(): Htmlable;

    /**
     * Get the timestamp for last update to entry
     * @return Carbon
     */
    public function getUpdated(): Carbon;

    /**
     * Get the timestamp of the original publication of the entry
     * @return Carbon
     */
    public function getPublished(): Carbon;

    /**
     * Check if the entry is published
     * @return bool
     */
    public function isPublic(): bool;

    /**
     * The entry's authors
     * An empty collection indicates the entry should be considered written by the blog's default author
     * @return Collection
     */
    public function getAuthors(): Collection;

    /**
     * The entry's main image (if applicable), tagged in html
     * @return Htmlable|null
     */
    public function getImage(): ?Htmlable;

    /**
     * Url for the entry's main image (if applicable)
     * @return string|null
     */
    public function getImageUrl(): ?string;

    /**
     * Get the entry's summary with markup
     * @return Htmlable
     */
    public function getSummary(): Htmlable;

    /**
     * Get the html head title for this entry
     * @param string $suffix to append after the title
     * @return string
     */
    public function getPageTitle(string $suffix = ''): string;

    /**
     * Get the meta-description for this entry
     * @return string|null
     */
    public function getMetaDescription(): ?string;

    /**
     * Get a unique id for this blog entry within the blog
     * @return string
     */
    public function getId(): string;

    /**
     * Check if complete entry contents should be made available in feed
     * @param bool $default
     * @return bool
     */
    public function displayFullEntryInFeed(bool $default = false): bool;
}
