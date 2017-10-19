<?php

namespace Bjuppa\LaravelBlog\Contracts;

interface Author
{
    public function getName(): string;

    public function getEmail(): ?string;

    public function getUrl(): ?string;
}
