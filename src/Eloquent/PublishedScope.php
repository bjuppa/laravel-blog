<?php

namespace Bjuppa\LaravelBlog\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PublishedScope implements Scope
{
    /**
     * All of the extensions to be added to the builder.
     *
     * @var array
     */
    protected $extensions = ['WithUnpublished', 'OnlyScheduledForPublishing', 'OnlyDrafts', 'OnlyUnpublished'];

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->where($model::PUBLISH_AFTER, '<=', $model->freshTimestamp())
            ->latestPublication();
    }

    /**
     * Extend the query builder with the needed functions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    public function extend(Builder $builder)
    {
        foreach ($this->extensions as $extension) {
            $this->{"add{$extension}"}($builder);
        }
    }

    /**
     * Add the with-unpublished extension to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    protected function addWithUnpublished(Builder $builder)
    {
        $builder->macro('withUnpublished', function (Builder $builder) {
            return $builder->withoutGlobalScope($this);
        });
    }

    /**
     * Add the only-scheduled-for-publishing extension to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    protected function addOnlyScheduledForPublishing(Builder $builder)
    {
        $builder->macro('onlyScheduledForPublishing', function (Builder $builder) {
            $model = $builder->getModel();

            return $builder->withoutGlobalScope($this)
                ->where($model::PUBLISH_AFTER, '>', $model->freshTimestamp());
        });
    }

    /**
     * Add the only-drafts extension to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    protected function addOnlyDrafts(Builder $builder)
    {
        $builder->macro('onlyDrafts', function (Builder $builder) {
            $model = $builder->getModel();

            return $builder->withoutGlobalScope($this)
                ->whereNull($model::PUBLISH_AFTER);
        });
    }

    /**
     * Add the only-unpublished extension to the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return void
     */
    protected function addOnlyUnpublished(Builder $builder)
    {
        $builder->macro('onlyUnpublished', function (Builder $builder) {
            return $builder->withoutGlobalScope($this)
                ->where(function ($builder) {
                    $model = $builder->getModel();
                    $builder->where($model::PUBLISH_AFTER, '>', $model->freshTimestamp())
                        ->orWhere(function ($builder) {
                            $model = $builder->getModel();
                            $builder->whereNull($model::PUBLISH_AFTER);
                        });
                });
        });
    }
}
