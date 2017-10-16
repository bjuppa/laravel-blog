<?php

namespace Bjuppa\LaravelBlog;

use Bjuppa\LaravelBlog\Contracts\Blog as BlogContract;
use Bjuppa\LaravelBlog\Contracts\BlogEntryProvider as BlogEntryProviderContract;
use Bjuppa\LaravelBlog\Contracts\BlogRegistry as BlogRegistryContract;
use Bjuppa\LaravelBlog\Eloquent\BlogEntryProvider;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function register()
    {
        $this->configure();

        /**
         * Resolve one global instance of the blog registry from the blog registry contract.
         */
        $this->app->singleton(BlogRegistryContract::class,
            config('blog.implementations.registry', BlogRegistry::class));

        /**
         * Resolve fresh default blog instances from the blog contract...
         */
        $this->app->bind(BlogContract::class,
            config('blog.implementations.blog', Blog::class));

        /**
         * Resolve fresh default entry providers from the provider contract.
         */
        $this->app->bind(BlogEntryProviderContract::class,
            config('blog.implementations.entry_provider', BlogEntryProvider::class));
    }

    /**
     * Bootstrap any application services.
     *
     * @param BlogRegistryContract $blog_registry
     */
    public function boot(BlogRegistryContract $blog_registry)
    {
        $this->configureBlogs($blog_registry);

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->registerResources();

        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
            $this->offerPublishing();
        }
    }

    /**
     * Setup the configuration.
     */
    protected function configure()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/blog.php', 'blog');
    }

    /**
     * Register the resources.
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'blog');
    }

    /**
     * Register migration files.
     */
    protected function registerMigrations()
    {
        if (true) {
            // TODO: have each entry provider implement a method returning path to migrations,
            // then collect them all within a callback to the app's "booted" event, to run after all service providers have finished
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }
    }

    /**
     * Setup the resource publishing groups.
     */
    protected function offerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/blog.php' => config_path('blog.php'),
        ], 'blog-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/blog'),
        ], 'blog-views');
    }

    /**
     * Configure blogs in the blog registry
     * @param BlogRegistryContract $blog_registry
     */
    protected function configureBlogs(BlogRegistryContract $blog_registry): void
    {
        foreach ((array)config('blog.blogs') as $blog_id => $blog_config) {
            $blog_registry->add($this->app->make(BlogContract::class,
                [
                    'blog_id' => $blog_id,
                    'configuration' => array_merge(config('blog.blog_defaults', []), $blog_config),
                ]));
        }
    }
}
