<?php

namespace Bjuppa\LaravelBlog\Eloquent;

use Bjuppa\LaravelBlog\Contracts\BlogEntry as BlogEntryContract;
use Illuminate\Database\Eloquent\Model as Eloquent;

class BlogEntry extends Eloquent implements BlogEntryContract
{
    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        if (!isset($this->table)) {
            //TODO: Should the entry model's table name come from a config file specific to the eloquent blog entries?
            return config('blog.eloquent_entries_table', function () {
                return parent::getTable();
            });
        }

        return $this->table;
    }
}
