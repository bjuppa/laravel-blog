<?php

namespace Bjuppa\LaravelBlog;

use Bjuppa\LaravelBlog\Contracts\Blog as BlogContract;
use Bjuppa\LaravelBlog\Contracts\BlogRegistry as BlogRegistryContract;
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
        $this->app->singleton(BlogRegistryContract::class, BlogRegistry::class);
        $this->app->bind(BlogContract::class, Blog::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @param BlogRegistryContract $registry
     * @return void
     */
    public function boot(BlogRegistryContract $registry)
    {
        $registry->configureMultipleBlogs(config('blog.blogs'));

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
            //TODO: The loaded migrations takes precedence over published migrations - so published migrations are never run
            // Is there a way to not load an individual migration if it already exists in the app's migrations folder?
            // Laravel Passport handles this using a static config on a class:
            // https://github.com/laravel/passport/blob/44209f4119fefa65bf17c885881918eb95fd1131/src/PassportServiceProvider.php#L62
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

        //TODO: perhaps we shouldn't publish the migrations at all?
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'migrations');
    }
}
