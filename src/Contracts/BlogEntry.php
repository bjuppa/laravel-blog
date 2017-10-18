<?php

namespace Bjuppa\LaravelBlog\Contracts;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Htmlable;

interface BlogEntry
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
    public function getUpdatedAt(): Carbon;

    /**
     * Get the timestamp of the original publication of the entry
     * @return Carbon
     */
    public function getPublishedAt(): Carbon;
}
