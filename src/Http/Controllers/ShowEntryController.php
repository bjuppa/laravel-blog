<?php

namespace Bjuppa\LaravelBlog\Http\Controllers;

use Bjuppa\LaravelBlog\Contracts\BlogEntry;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        throw_unless(
            $entry->isPublic() or Gate::allows($this->blog->getPreviewAbility(), $entry),
            NotFoundHttpException::class
        );
        /**
         * @var $entry BlogEntry
         */

        return View::first($this->blog->bladeViews('entry', $entry))->with('entry', $entry);
    }
}
