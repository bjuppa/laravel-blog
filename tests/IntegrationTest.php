<?php

namespace Bjuppa\LaravelBlog\Tests;

use Orchestra\Testbench\TestCase;

abstract class IntegrationTest extends TestCase
{
    /**
     * Setup the test case.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Tear down the test case.
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Get the service providers for the package.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return ['Bjuppa\LaravelBlog\BlogServiceProvider'];
    }

    /**
     * Configure the environment.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        //
    }
}
