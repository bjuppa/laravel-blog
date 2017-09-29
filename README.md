# laravel-blog
This package will become a flexible blogging solution that you can add to your Laravel app.

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

### My needs are:
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

## Package development & testing
`vendor/bin/phpunit` from the project directory will run the default test suite.

If you want your own local configuration for phpunit,
copy the file `phpunit.xml.dist` to `phpunit.xml` and modify the latter to your needs.
