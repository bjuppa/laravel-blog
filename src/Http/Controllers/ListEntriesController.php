<?php

namespace Bjuppa\LaravelBlog\Http\Controllers;

class ListEntriesController extends BaseBlogController
{
    public function showIndex()
    {
        //TODO: retrieve a list of the latest entries from the blog
        return view('blog::index', ['entries' => []]);
    }
}
