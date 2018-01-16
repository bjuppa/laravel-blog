<?php

namespace Bjuppa\LaravelBlog\Http\Controllers;

use Bjuppa\LaravelBlog\Contracts\BlogEntry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\View;

class ShowEntryController extends BaseBlogController
{
    /**
     * Show a blog entry in a view
     *
     * @param string $slug
     * @return \Illuminate\View\View
     * @throws NotFoundHttpException
     * @throws \Throwable
     */
    public function __invoke($slug)
    {
        throw_unless($entry = $this->blog->findEntry($slug), NotFoundHttpException::class);
        /**
         * @var $entry BlogEntry
         */

        return View::first([
            'blog::entry-' . $this->blog->getId() . '-' . $entry->getId(),
            'blog::entry-' . $this->blog->getId(),
            'blog::entry',
        ])
            ->with('entry', $entry);
    }
}
