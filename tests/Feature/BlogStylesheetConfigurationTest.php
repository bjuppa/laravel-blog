<?php

namespace Bjuppa\LaravelBlog\Tests\Feature;

use Bjuppa\LaravelBlog\Tests\IntegrationTest;

class BlogStylesheetConfigurationTest extends IntegrationTest
{
    protected $fakeEntryProvider = true;

    protected function extraConfigs(): array
    {
        return ['blog.blogs.main.stylesheets' => 'style.css'];
    }

    public function test_css_is_linked()
    {
        $response = $this->get('blog');

        $response->assertSee('style.css');
    }

}
