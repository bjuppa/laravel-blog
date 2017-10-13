<?php

namespace Bjuppa\LaravelBlog\Http\Controllers;

class ListEntriesController extends BaseBlogController
{
    public function showIndex()
    {
        return view('blog::index', ['entries' => $this->blog->latestEntries()]);
    }
}
