# laravel-blog

This package is a flexible blogging solution that you can add to your
[Laravel](https://laravel.com) app.

Is takes blog entries from _storage_ and publishes them to
[the Web](https://en.wikipedia.org/wiki/World_Wide_Web)
in common formats for consumption by people and machines through URLs.

Each blog gets:

- An index page listing the latest entries
- A page for each blog entry displaying its full contents
- An [Atom feed](<https://en.wikipedia.org/wiki/Atom_(standard)>)

The default storage is [Eloquent](https://laravel.com/docs/eloquent),
but you may create your own `BlogEntryProvider` should you wish.
Have a look at the files in
[`src/Contracts`](https://github.com/bjuppa/laravel-blog/tree/master/src/Contracts)
for a quick overview of the entites this package handles.

## Admin interface

This package **does not** provide any admin interface for editing blog entries.
There's a
[separate package](https://packagist.org/packages/bjuppa/laravel-blog-admin)
that can _optionally_ be installed to provide admin routes for editing blog
contents.

Another option is to create the mechanism to edit blog entries yourself,
in your Laravel app.
[Entries](https://github.com/bjuppa/laravel-blog/blob/master/src/Eloquent/BlogEntry.php)
are represented by [Eloquent models](https://laravel.com/docs/eloquent)
by default, so shouldn't be too hard for Laravel developers.

## Requirements

You need at least **Laravel 7** to use this package.
The included
[entry model](https://github.com/bjuppa/laravel-blog/blob/master/src/Eloquent/BlogEntry.php)
and
[migration](https://github.com/bjuppa/laravel-blog/blob/master/database/migrations/2017_10_04_000000_create_blog_entries_table.php)
requires a database connection supporting json-type columns.

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

3. Edit the published configuration file `config/blog.php`
to setup your desired blogs and their options.

    Configurations may be changed later and more blogs can be added etc.
    Just remember that permalinks and generated entry IDs should ideally be
    kept constant after a blog has been published to avoid broken feeds and
    links for your audience.

    The service provider handles registration of routes to all configured blogs.
    You can check which routes and paths are generated using:

    ```bash
    php artisan route:list
    ```

4. Run migrations to automatically set up any tables needed to use the
configured blog entry providers:

    ```bash
    php artisan migrate
    ```

5. (optional) If you want to create a default blog entry in the database you
can run the seeder:

    ```bash
    php artisan db:seed --class="Bjuppa\LaravelBlog\Database\Seeds\DefaultBlogEntrySeeder"
    ```

6. (optional) If you want to use the included styling, first publish the CSS
to your public directory:

    ```bash
    php artisan vendor:publish --provider="Bjuppa\LaravelBlog\BlogServiceProvider" --tag="blog-styling"
    ```

    ...then edit `config/blog.php` and add `'css/blog.css'`
    to the `stylesheets` config.

Now visit your fresh blog in a browser!
The default url path is `/blog` unless you've changed the config.

## Edit blog posts

Add and edit blog entries in the database any way you like.
You can create your own admin interface, write straight to the database,
or perhaps use
[`php artisan tinker`](https://laravel.com/docs/artisan#introduction)... 😉
The model used by default is
[`Bjuppa\LaravelBlog\Eloquent\BlogEntry`](https://github.com/bjuppa/laravel-blog/blob/master/src/Eloquent/BlogEntry.php).

There is [a separate package providing an admin interface](#admin-interface).

### User permissions

All published entries are public to *view* by anyone at their url.

To enable users to *preview* unpublished entries, first create a Laravel
[gate](https://laravel.com/docs/authorization#gates) or
[policy](https://laravel.com/docs/authorization#creating-policies)
(for your entry model) and then configure the `preview_ability` in your
`config/blog.php` to match.

A gate defined in your `App\Providers\AuthServiceProvider` could look like this:

```php
Gate::define('preview blog entries', function ($user) {
  // Check for your own admin user model, or some other criteria!
  return $user instanceof \App\AdminUser;
});
```

## Styling the frontend

The included CSS file is built using
[Kingdom CSS](https://bjuppa.github.io/kingdom/),
which is yet another CSS framework, created by... yours truly.

The default styling is meant to add some consistent styling to the standard
HTML elements, so a blog using it will not look "designed", although it has
some opinionated layout and spacing (especially on a larger screen).
You could say it has a ["brutalist"](https://brutalist-web.design) approach,
it even uses browsers' default fonts.

### Using the included utility classes

Blog authors may want to add some special styles to elements within
their entries.
Some classes are useful on elements that are on the first level within
entry contents:

- `.full-bleed` will expand the element to cover the entire width
  of the viewport - great for images.
- `.start-margin-bleed` and `.end-margin-bleed` will make the element extend
  into the left or right margin.
- `.float-right` and `.float-left` will float the element in single-column view.
- `.span-content` will make the element cover both columns when the screen is
  big enough for a two-column view - good for elements that require more
  space, but not the full width.
- `.full-column-bleed` is similar to `.full-bleed` but will not
  cover multiple columns.
- `.blog-related-content` will move the the element into the first available
  row of the second column - great for `<aside>` elements and other
  content that is related to the entry, but doesn't need to
  follow exactly in the flow.

  (The ads section is an example of this, that goes into the first free slot
  of the second column)

  If your related content needs to cover more than one row in the second column,
  you can add utility classes `.grid-row-span-2`, `.grid-row-span-3`,
  etc (from Kingdom).

The included CSS contains many of Kingdom's utility classes, they're too many
to document here, please refer to the original SASS files:

- [`_colors.scss`](https://github.com/bjuppa/kingdom/blob/master/src/utilities/_colors.scss)
- [`_borders.scss`](https://github.com/bjuppa/kingdom/blob/master/src/utilities/_borders.scss)
- [`_sizing.scss`](https://github.com/bjuppa/kingdom/blob/master/src/utilities/_sizing.scss)
- [`_spacing.scss`](https://github.com/bjuppa/kingdom/blob/master/src/utilities/_spacing.scss)
- [`layout/_lists.scss`](https://github.com/bjuppa/kingdom/blob/master/src/utilities/layout/_lists.scss)
- [`layout/_screenreaders.scss`](https://github.com/bjuppa/kingdom/blob/master/src/utilities/layout/_screenreaders.scss)
- [`layout/_floats.scss`](https://github.com/bjuppa/kingdom/blob/master/src/utilities/layout/_floats.scss)
- [`layout/_grid.scss`](https://github.com/bjuppa/kingdom/blob/master/src/utilities/layout/_grid.scss)
- [`text/_whitespace-wrapping.scss`](https://github.com/bjuppa/kingdom/blob/master/src/utilities/text/_whitespace-wrapping.scss)

### Creating your own styles

You probably want to create your own styles to apply your personal
touch or branding.
The `stylesheets` config in your `config/blog.php` is where you can include
any CSS files you want into your blog.

You can add a list of files so you can combine this package's CSS file with an
additional CSS file containing your own styles.
Or you can use [Laravel Mix](https://laravel.com/docs/mix)
to combine them into a single file.

## Blade templates

The package keeps all its Blade views in
[`resources/views`](https://github.com/bjuppa/laravel-blog/tree/master/resources/views)
and running this command will publish all of them into
`resources/views/vendor/blog` of your app so you can edit them:

```bash
php artisan vendor:publish --provider="Bjuppa\LaravelBlog\BlogServiceProvider" --tag="blog-views"
```

...however you probably only need to change a few bits in just some files.
I'd recommend you to only commit the files you actually change to version
control, and remove the rest of the published files that you have not
changed from your app.
Blade will fall back to using the package's views for any file not found in
the `vendor` view directory.

## Localization

This package contains English translation strings that can be published
to your app using this command:

```bash
php artisan vendor:publish --provider="Bjuppa\LaravelBlog\BlogServiceProvider" --tag="blog-translations"
```

If you're not adding translations for a new language, you probably don't need
all the files and not even all the strings within a file.
Consider overriding just the ones you want, as explained in the
[Laravel documentation](https://laravel.com/docs/localization#overriding-package-language-files).

## Custom entry providers and models

It is possible to pull out any configured `Blog` from the `BlogRegistry` within
the `boot()` method of any Laravel service provider, and manipulate it beyond
what is possible using the configuration files alone.

To use a custom `BlogEntryProvider` one can set it on an individual
`Blog` using `withEntryProvider()`.

To just use a custom entry model with a `Blog` one can use
`getEntryProvider()->withEntryModel()`,
as long as the entry provider is a
`Bjuppa\LaravelBlog\Eloquent\BlogEntryProvider`.

## Background

When looking for ways to add a simple blog to an existing Laravel app I found
[many packages](https://packagist.org/?q=laravel%20blog)
and some complete Laravel apps, but none of them did what I expected:

**Provide a highly configurable blog add-on
that can be integrated into any Laravel app**.

Povilas Korop had written
[a blog post about it](https://quickadminpanel.com/blog/blog-packages-for-laravel-nothing-to-choose-from/)
some half a year before I ran into the same need.
This package is my attempt at getting myself a couple of blogs without resorting
to WordPress and hopefully provide something useful for other developers.

### My needs were

- One ore more blogs must be configurable within the same Laravel app
- Simple configuration after package install
  (ideally just running migrations if only one standard blog)
- Publish [Atom feeds](<https://en.wikipedia.org/wiki/Atom_(standard)>)
- Provide a default Eloquent model for posts/entries, but make it user
  replaceable per blog
- Configurable urls to avoid clashes with existing app routes
- Flexible and replaceable default views
- Named routes for easy linking from the rest of the Laravel app
- Optional admin panel, so you can write or use your own admin pages if you
  already have one
