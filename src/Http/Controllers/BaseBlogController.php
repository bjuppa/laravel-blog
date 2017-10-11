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
     * @param Request $request
     */
    public function __construct(BlogRegistry $registry, Request $request)
    {
        $this->blog = $registry->getBlogMatchingRequest($request);
    }
}
