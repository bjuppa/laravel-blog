<?php

namespace Bjuppa\LaravelBlog\Http\Controllers;

use Bjuppa\LaravelBlog\Contracts\Blog;
use Illuminate\Routing\Controller as BaseController;

abstract class BaseBlogController extends BaseController
{
    /**
     * The current Blog instance of the route
     * @var Blog
     */
    protected $blog;

    /**
     * EntryListController constructor.
     * @param Blog $blog
     */
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }
}
