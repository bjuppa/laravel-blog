<?php

namespace Bjuppa\LaravelBlog\Http\Controllers;

class ShowEntryController extends BaseBlogController
{
    public function __invoke($slug)
    {
        //TODO: pull out the entry from the blog using slug
        return $this->blog->getEntryProvider();
    }
}
