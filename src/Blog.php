<?php

namespace Bjuppa\LaravelBlog;

use Bjuppa\LaravelBlog\Contracts\Blog as BlogContract;

class Blog implements BlogContract
{
    /**
     * Blog identifier
     * @var string
     */
    protected $id;

    /**
     * The path part of this blog's url
     * @var string
     */
    protected $public_path = 'blog';

    /**
     * Blog constructor.
     *
     * @param string $id
     * @param iterable $configuration
     */
    public function __construct(string $id, iterable $configuration = [])
    {
        $this->id = $id;
        $this->configure($configuration);
    }

    /**
     * Set configuration values on the blog
     *
     * @param iterable $configuration
     * @return $this
     */
    public function configure(iterable $configuration): BlogContract
    {
        foreach ($configuration as $config_name => $config_value) {
            $method_name = 'with' . studly_case($config_name);
            try {
                $reflection = new \ReflectionMethod($this, $method_name);
                if ($reflection->isPublic()) {
                    $this->$method_name($config_value);
                }
            } catch (\Exception $e) {
                // Do nothing
            }
        }

        return $this;
    }

    /**
     * Set the path part of the url to the blog
     *
     * @param string $path
     * @return $this
     */
    public function withPublicPath(string $path)
    {
        $this->public_path = $path;

        return $this;
    }

    /**
     * Get the path part of the url to the blog
     *
     * @return string
     */
    public function getPublicPath(): string
    {
        return $this->public_path;
    }

    /**
     * Get the blog's identifier
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
