# Package development & testing

Run `composer test` from the project directory to start the default test suite.

Logs created during test runs can be found in `vendor/orchestra/testbench-core/laravel/storage/logs/`

If you want your own local configuration for phpunit,
copy the file `phpunit.xml.dist` to `phpunit.xml` and modify the latter to your needs.

## Dependency version testing

- `composer update --prefer-lowest` can be used before running tests for testing backwards compatibility.
- `composer show -D -o` can be used to check how far behind latest version the currently installed dependencies are.
- `composer update` will install the latest versions of dependencies.

## Continuous integration

[Travis CI](https://travis-ci.org/bjuppa/laravel-blog) is set up to run tests on multiple versions of PHP and Laravel
whenever a git push or a PR is made.

## Compiled views

Running `composer clearCompiledViews` will delete the contents of
`vendor/orchestra/testbench-core/laravel/storage/framework/views/`
and this is automatically triggered when composer updates dependencies.

## Building assets

Assets are built using standalone [Laravel Mix](https://laravel-mix.com/docs/installation).
Install dependencies using `npm install` and then `npm run dev` or `npm run watch` will build assets
into the `/dist` directory.

Before `git push` of built assets, do `npn run production` to generate minified assets.

### Testing this package within a Laravel app

If you're editing and building assets within a repo in the vendor folder of a real Laravel app,
running this command will publish the updated styles:

```bash
php artisan vendor:publish --provider="Bjuppa\LaravelBlog\BlogServiceProvider" --tag="blog-styling" --force
```

And this command will generate some test entries in the database that can be useful for styling:

```bash
php artisan db:seed --class="Bjuppa\LaravelBlog\Database\Seeds\StylingTestEntriesSeeder"
```

## Release new version

Releases are handled through [the GitHub releases interface](https://github.com/bjuppa/laravel-blog/releases).
