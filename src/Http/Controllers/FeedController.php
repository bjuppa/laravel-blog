<?php

namespace Bjuppa\LaravelBlog\Http\Controllers;

use Illuminate\Support\Facades\View;

class FeedController extends BaseBlogController
{
    /**
     * Atom feed for a blog
     *
     * @return \Illuminate\View\View
     */
    public function __invoke()
    {
        return View::first($this->blog->bladeViews('feed'), ['entries' => $this->blog->latestEntries()]);
    }
}
