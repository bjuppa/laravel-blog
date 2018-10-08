# laravel-blog

This package will become a flexible blogging solution that you can add to your Laravel app.

**This package does not yet have a stable release** - Please don't use it in production!

This package's job is to take blog entries from *storage* and publish them to
[the Web](https://en.wikipedia.org/wiki/World_Wide_Web)
in common formats for consumption by people and machines through URLs.

Each blog gets:

- An index page listing the latest entries
- A page for each blog entry displaying its full contents
- An [Atom feed](https://en.wikipedia.org/wiki/Atom_(standard))

## Admin interface

This package *does not* provide any admin interface for editing blog entries.
There are plans for a (near) future release of a separate package
that can optionally be installed to provide admin routes for editing blog contents.

For now, you'll need to create the mechanism to edit blog entries yourself.
Entries are represented by [Eloquent models](https://laravel.com/docs/eloquent) by default,
so shouldn't be too hard for Laravel developers.

## Background

When looking for ways to add a simple blog to an existing Laravel app I found
[many packages](https://packagist.org/?q=laravel%20blog)
and some complete Laravel apps, but none of them did what I expected:

**Provide a highly configurable blog add-on that can be integrated into any Laravel app**.

Povilas Korop had written
[a blog post about it](https://quickadminpanel.com/blog/blog-packages-for-laravel-nothing-to-choose-from/)
some half a year before I ran into the same need.
This package is my attempt at getting myself a couple of blogs without resorting to WordPress
and hopefully provide something useful for other developers.

### My needs are

- One ore more blogs must be configurable within the same Laravel app
- Simple configuration after package install (ideally just running migrations if only one standard blog)
- Publish [Atom feeds](https://en.wikipedia.org/wiki/Atom_(standard))
- Provide a default Eloquent model for posts, but make it user replaceable per blog
- Configurable urls to avoid clashes with existing app routes
- Flexible and replaceable default views
- Named routes for easy linking from the rest of the Laravel app
- Optional admin panel, so you can write or use your own admin pages if you already have one

PS: I don't yet have a blog where I can write about development (duh) so
**stay tuned for the first release!**

## Requirements

You need at least **Laravel 5.6.8** to use this package.

## Usage

1. Require the package:

    ```bash
    composer require bjuppa/laravel-blog
    ```

    The package will automatically register itself.

2. Publish the configuration file:

    ```bash
    php artisan vendor:publish --provider="Bjuppa\LaravelBlog\BlogServiceProvider" --tag="blog-config"
    ```

3. Edit the published configuration file `config/blog.php` to setup your desired blogs and their options.

    Configurations may be changed later and more blogs can be added etc.
    Just remember that permalinks and generated entry IDs should ideally be kept constant
    after a blog has been published to avoid broken feeds and links for your audience.

    The service provider handles registration of routes to all configured blogs.
    You can check which routes and paths are generated using:

    ```bash
    php artisan route:list
    ```

4. Run migrations to automatically set up any tables needed to use the configured blog entry providers:

    ```bash
    php artisan migrate
    ```

5. If you want to create a default blog entry in the database you can run the seeder:

    ```bash
    php artisan db:seed --class="Bjuppa\LaravelBlog\Database\Seeds\DefaultBlogEntrySeeder"
    ```

6. If you want to use the included styling, first publish the CSS to your public directory:

    ```bash
    php artisan vendor:publish --provider="Bjuppa\LaravelBlog\BlogServiceProvider" --tag="blog-styling"
    ```

    ...then edit `config/blog.php` and add `'css/blog.css'` to the `stylesheets` config.
