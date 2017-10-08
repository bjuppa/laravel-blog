<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Tests\IntegrationTest;
use Illuminate\Support\Facades\Route;

class RouteTest extends IntegrationTest
{
    public function test_default_blog_has_routes()
    {
        $this->assertTrue(Route::has('blog.default.index'));
        $this->assertTrue(Route::has('blog.default.entry'));
    }
}
