<?php

namespace Bjuppa\LaravelBlog\Http\Controllers;

use Illuminate\Support\Facades\View;

class ListEntriesController extends BaseBlogController
{
    public function showIndex()
    {
        return View::first($this->blog->bladeViews('index'))->with('entries', $this->blog->latestEntries());
    }
}
