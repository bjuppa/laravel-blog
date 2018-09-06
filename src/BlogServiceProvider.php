<?php

namespace Bjuppa\LaravelBlog;

use Bjuppa\LaravelBlog\Contracts\Blog as BlogContract;
use Bjuppa\LaravelBlog\Contracts\BlogEntryProvider as BlogEntryProviderContract;
use Bjuppa\LaravelBlog\Contracts\BlogRegistry as BlogRegistryContract;
use Bjuppa\LaravelBlog\Eloquent\AbstractBlogEntry as AbstractEloquentBlogEntry;
use Bjuppa\LaravelBlog\Eloquent\BlogEntry as EloquentBlogEntry;
use Bjuppa\LaravelBlog\Eloquent\BlogEntryProvider as EloquentBlogEntryProvider;
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
            config('blog.implementations.entry_provider', EloquentBlogEntryProvider::class));

        /**
         * Resolve default eloquent entry instances from the abstract model.
         */
        $this->app->bind(AbstractEloquentBlogEntry::class,
            config('blog-eloquent.implementations.entry', EloquentBlogEntry::class));
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
        $this->mergeConfigFrom(__DIR__ . '/../config/blog-eloquent.php', 'blog-eloquent');
        $this->mergeConfigFrom(__DIR__ . '/../config/blog-sharing.php', 'blog-sharing');

        // Ensure default config values are set for those that are used in two or more places
        if (empty(config('blog.view_namespace'))) {
            config(['blog.view_namespace' => 'blog']);
        }
        if (empty(config('blog.trans_namespace'))) {
            config(['blog.trans_namespace' => 'blog']);
        }
    }

    /**
     * Register the resources.
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', config('blog.view_namespace'));
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', config('blog.trans_namespace'));
    }

    /**
     * Register migration files for each active EntryProvider.
     */
    protected function registerMigrations()
    {
        // Register the migrations at the app's booted event to have all service providers finish first
        $this->app->booted(function ($app) {
            /**
             * @var $registry \Bjuppa\LaravelBlog\Contracts\BlogRegistry
             */
            $registry = $app->make(\Bjuppa\LaravelBlog\Contracts\BlogRegistry::class);

            if ($registry->all()
                ->map->getEntryProvider()
                ->whereInstanceOf(EloquentBlogEntryProvider::class)
                ->map->getBlogEntryModel()
                ->whereInstanceOf(EloquentBlogEntry::class)
                ->isNotEmpty()
            ) {
                $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
            }
        });
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
            __DIR__ . '/../config/blog-eloquent.php' => config_path('blog-eloquent.php'),
        ], 'blog-eloquent-config');

        $this->publishes([
            __DIR__ . '/../config/blog-sharing.php' => config_path('blog-sharing.php'),
        ], 'blog-sharing-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/' . config('blog.view_namespace')),
        ], 'blog-views');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/' . config('blog.trans_namespace')),
        ], 'blog-translations');

        $this->publishes([
            __DIR__ . '/../dist/blog.css' => public_path('css/blog.css'),
        ], 'blog-styling');
    }

    /**
     * Configure blogs in the blog registry
     * @param BlogRegistryContract $blog_registry
     */
    protected function configureBlogs(BlogRegistryContract $blog_registry): void
    {
        foreach ((array) config('blog.blogs') as $blog_id => $blog_config) {
            $blog_registry->add($this->app->make(BlogContract::class,
                [
                    'blog_id' => $blog_id,
                    'configuration' => array_merge(config('blog.blog_defaults', []), $blog_config),
                ]));
        }
    }
}
