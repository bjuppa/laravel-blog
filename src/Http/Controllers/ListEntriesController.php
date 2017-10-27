<?php

namespace Bjuppa\LaravelBlog\Http\Controllers;

use Illuminate\Support\Facades\View;

class ListEntriesController extends BaseBlogController
{
    public function showIndex()
    {
        return View::first([
            'blog::index-' . $this->blog->getId(),
            'blog::index',
        ])
            ->with('entries', $this->blog->latestEntries());
    }
}
