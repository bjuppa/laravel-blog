<?php

namespace Bjuppa\LaravelBlog\Support;

trait ProvidesTranslationKeys {
    /**
     * Get a fully qualified translation key
     * Suitable for Laravel's translation functions __(), trans() or trans_choice()
     * @param string $name
     * @return string
     */
    public function transKey($name): string
    {
        return config('blog.trans_namespace') . '::' . $name;
    }
}
