<?php

namespace Bjuppa\LaravelBlog\Http\Controllers;

class ListEntriesController extends BaseBlogController
{
    public function showIndex()
    {
        //TODO: return a list view
        return 'Blog index for '.$this->blog->getId();
    }
}
