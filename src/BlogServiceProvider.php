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
        $this->app->singleton(BlogRegistryContract::class, BlogRegistry::class);
        $this->app->bind(BlogContract::class, Blog::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerMigrations();
            $this->offerPublishing();
        }
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
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        //TODO: publish views
    }
}
