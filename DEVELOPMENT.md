# Package development & testing

Run `composer test` from the project directory to start the default test suite.

Logs created during test runs can be found in `vendor/orchestra/testbench-core/laravel/storage/logs/`

If you want your own local configuration for phpunit,
copy the file `phpunit.xml.dist` to `phpunit.xml` and modify the latter to your needs.

- `composer update --prefer-lowest` can be used before running tests for testing backwards compatibility.
- `composer show -D -o` can be used to check how far behind latest version the currently installed dependencies are.
- `composer update` will install the latest versions of dependencies.

Running `composer clearCompiledViews` will delete the contents of
`vendor/orchestra/testbench-core/laravel/storage/framework/views/`
and this is automatically triggered when composer updates dependencies.
