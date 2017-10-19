<?php

namespace Bjuppa\LaravelBlog\Support;

use Bjuppa\LaravelBlog\Contracts\Author as AuthorContract;
use Illuminate\Contracts\Support\Arrayable;

class Author implements AuthorContract
{
    protected $name;
    protected $email;
    protected $url;

    /**
     * Create author from
     * @param string|iterable $author_data
     */
    public function __construct($author_data)
    {
        if ($author_data instanceof AuthorContract) {
            $this->name = $author_data->getName();
            $this->email = $author_data->getEmail();
            $this->url = $author_data->getUrl();
            return;
        }

        if ($author_data instanceof Arrayable) {
            $author_data = $author_data->toArray();
        }

        if (is_iterable($author_data)) {
            foreach ($author_data as $key => $value) {
                if (in_array($key, ['url', 'uri', 'link'], true) or starts_with($value, ['http://','https://'])) {
                    $this->url = $value;
                } elseif (in_array($key, ['email', 'mail'], true) or strpos($value,'@')) {
                    $this->email = $value;
                } else {
                    $name_parts = explode(' ', $this->name);
                    $name_parts[] = trim($value);
                    $this->name = implode(' ', array_filter($name_parts));
                }
            }
            if (empty($this->name)) {
                $this->name = $this->email ?? $this->url;
            }
            return;
        }

        $this->name = (string)$author_data;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }
}
