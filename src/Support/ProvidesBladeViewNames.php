<?php

namespace Bjuppa\LaravelBlog\Support;

use Bjuppa\LaravelBlog\Contracts\BlogEntry;

trait ProvidesBladeViewNames {
    /**
     * Get a fully qualified view name
     * Suitable for Blade directives @extends(), @include() or @each()
     * @param string $name
     * @return string
     */
    public function bladeView($name): string
    {
        return config('blog.view_namespace') . '::' . $name;
    }

    /**
     * Get an array of fully qualified views in descending priority order
     * Suitable for Blade directive @includeFirst()
     * @param string $name
     * @param BlogEntry|null $entry
     * @return array
     */
    public function bladeViews($name, BlogEntry $entry = null): array
    {
        $views = [$this->bladeView($name)];
        array_unshift($views, $views[0] . '-' . $this->getId());
        if($entry) {
            array_unshift($views, $views[1] . '-' . $entry->getId());
        }
        return $views;
    }
}
