<?php

namespace Bjuppa\LaravelBlog\Contracts;

interface ProvidesBladeViewNames
{
    /**
     * Get a fully qualified view name
     * Suitable for Blade directives @extends(), @include() or @each()
     * @param string $name
     * @return string
     */
    public function bladeView($name): string;

    /**
     * Get an array of fully qualified views in descending priority order
     * Suitable for Blade directive @includeFirst()
     * @param string $name
     * @param BlogEntry|null $entry
     * @return array
     */
    public function bladeViews($name, BlogEntry $entry = null): array;
}
