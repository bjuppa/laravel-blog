<?php

namespace Bjuppa\LaravelBlog\Contracts;

interface ProvidesDatabaseMigrationsPath
{
    /**
     * Return the path to database migrations for models.
     * @return string
     */
    public function getDatabaseMigrationsPath(): string;
}
