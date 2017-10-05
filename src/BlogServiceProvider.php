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
     *
     * @return void
     */
    public function register()
    {
        $this->configure();
        $this->app->singleton(BlogRegistryContract::class,
            config('blog.implementations.registry', BlogRegistry::class));
        $this->app->bind(BlogContract::class,
            config('blog.implementations.blog', Blog::class));
        $this->app->bind(BlogEntryProviderContract::class,
            config('blog.implementations.entry_provider', BlogEntryProvider::class));
    }

    /**
     * Bootstrap any application services.
     *
     * @param BlogRegistryContract $blog_registry
     * @return void
     */
    public function boot(BlogRegistryContract $blog_registry)
    {
        $blog_registry->configureMultipleBlogs(config('blog.blogs'));

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->registerResources();

        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
            $this->offerPublishing();
        }
    }

    /**
     * Setup the configuration.
     *
     * @return void
     */
    protected function configure()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/blog.php', 'blog');
    }

    /**
     * Register the resources.
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'blog');
    }

    /**
     * Register migration files.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        if (true) {
            //TODO: only load migrations if any blog is set to use the \Bjuppa\LaravelBlog\Eloquent\BlogEntry class
            // That may be tricky... when this service provider's boot method is run, we're not at a point yet where we know if any blog will use the default BlogEntry class...
            // Perhaps we can add this as a closure to the BlogRegistry here and have it execute later at the time when the blogs' routes are published?
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }
    }

    /**
     * Setup the resource publishing groups.
     *
     * @return void
     */
    protected function offerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/blog.php' => config_path('blog.php'),
        ], 'config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/blog'),
        ], 'views');
    }
}
