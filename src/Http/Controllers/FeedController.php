<?php

namespace Bjuppa\LaravelBlog\Http\Controllers;

class FeedController extends BaseBlogController
{
    /**
     * Atom feed for a blog
     *
     * @return string
     */
    public function __invoke()
    {
        return view('blog::feed', ['entries' => $this->blog->latestEntries()]);
    }
}
