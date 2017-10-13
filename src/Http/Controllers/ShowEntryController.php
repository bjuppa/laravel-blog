<?php

namespace Bjuppa\LaravelBlog\Http\Controllers;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShowEntryController extends BaseBlogController
{
    /**
     * Show a blog entry in a view
     *
     * @param $slug
     * @return string
     */
    public function __invoke($slug)
    {
        $entry = $this->blog->findEntry($slug);
        throw_if(empty($entry), NotFoundHttpException::class);

        return view('blog::entry', ['entry' => $entry]);
    }
}
