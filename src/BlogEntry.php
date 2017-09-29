<?php

namespace Bjuppa\LaravelBlog;

use Bjuppa\LaravelBlog\Contracts\BlogEntry as BlogEntryContract;
use Illuminate\Database\Eloquent\Model as Eloquent;

class BlogEntry extends Eloquent implements BlogEntryContract
{

}
