<?php

namespace Bjuppa\LaravelBlog\Http\Controllers;

use Bjuppa\LaravelBlog\Contracts\BlogRegistry;
use Bjuppa\LaravelBlog\Contracts\Blog;
use Illuminate\Http\Request;
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
     * @param BlogRegistry $registry
     */
    public function __construct(Request $request, BlogRegistry $registry)
    {
        $this->blog = $registry->getBlogMatchingRequest($request);
    }
}
