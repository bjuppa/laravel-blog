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
    protected $extensions = ['WithUnpublished'];

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->whereNotNull($model::PUBLISH_AFTER); // Comparing the fresh timestamp to null always returns null in MySQL, so this not null rule is here just to be overly obvious
        $builder->where($model::PUBLISH_AFTER, '<=', $model->freshTimestamp());
        $builder->latestPublication();
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

    //TODO: add withUnpublished() removing this global scope to list all like in \Illuminate\Database\Eloquent\SoftDeletingScope
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

    //TODO: add onlyUnpublished() listing all apart from those that are published like in \Illuminate\Database\Eloquent\SoftDeletingScope
    //TODO: add onlyScheduledForPublishing() listing only those that have a publish time set
    //TODO: add onlyDrafts() listing only those that have no publish time set at all
}
