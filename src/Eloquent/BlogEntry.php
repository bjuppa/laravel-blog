<?php

namespace Bjuppa\LaravelBlog\Eloquent;

use Bjuppa\LaravelBlog\Contracts\BlogEntry as BlogEntryContract;
use Illuminate\Database\Eloquent\Model as Eloquent;

class BlogEntry extends Eloquent implements BlogEntryContract
{

}
