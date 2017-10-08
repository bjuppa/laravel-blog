<?php

namespace Bjuppa\LaravelBlog\Http\Controllers;

class ListEntriesController extends BaseBlogController
{
    public function showIndex()
    {
        //TODO: return a list view
        return $this->blog;
    }
}
