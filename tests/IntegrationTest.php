<?php

namespace Bjuppa\LaravelBlog\Tests;

use Bjuppa\LaravelBlog\Contracts\BlogEntryProvider as BlogEntryProviderContract;
use Bjuppa\LaravelBlog\Database\Seeds\DefaultBlogEntrySeeder;
use Bjuppa\LaravelBlog\Tests\Feature\Fakes\BlogEntryProvider as FakeBlogEntryProvider;
use Orchestra\Testbench\TestCase;

abstract class IntegrationTest extends TestCase
{
    /**
     * Whether to use a fake entry provider instance
     * @var bool
     */
    protected $fakeEntryProvider = false;

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
        return [
            'Bjuppa\LaravelBlog\BlogServiceProvider',
        ];
    }

    /**
     * Configure the environment.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        foreach ($this->extraConfigs() as $key => $value) {
            $app['config']->set($key, $value);
        }

        if ($this->fakeEntryProvider) {
            $app->bind(BlogEntryProviderContract::class, FakeBlogEntryProvider::class);
        }
    }

    /**
     * Set up database for testing.
     */
    protected function prepareDatabase()
    {
        // Run any migrations registered in service providers
        $this->loadRegisteredMigrations();

        $this->withFactories(__DIR__ . '/../database/factories');
    }

    /**
     * Override this method to set configuration values in your test class
     *
     * @return array of config keys (in dot-notation) and values
     */
    protected function extraConfigs(): array
    {
        return [];
    }

    /**
     * Run the migrations registered in the app
     */
    protected function loadRegisteredMigrations()
    {
        $this->artisan('migrate');

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback');
        });
    }

    /**
     * Put the default blog entry into the database
     */
    protected function seedDefaultBlogEntry()
    {
        $options['--class'] = DefaultBlogEntrySeeder::class;
        $this->artisan('db:seed', $options);
    }
}
