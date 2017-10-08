<?php

namespace Bjuppa\LaravelBlog;

use Bjuppa\LaravelBlog\Contracts\Blog as BlogContract;
use Bjuppa\LaravelBlog\Contracts\BlogEntryProvider;
use Bjuppa\LaravelBlog\Exceptions\InvalidConfiguration;
use Illuminate\Contracts\Container\Container;

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
     * Instance of a blog entry provider to pull blog entries from
     * @var BlogEntryProvider
     */
    protected $entry_provider;

    /**
     * Blog constructor.
     *
     * @param Container $app
     * @param string $blog_id
     * @param iterable $configuration
     * @throws \Bjuppa\LaravelBlog\Exceptions\InvalidConfiguration
     */
    public function __construct(string $blog_id, iterable $configuration = [])
    {
        $this->id = $blog_id;

        $this->configure($configuration);

        // Resolve a default entry provider
        if (empty($this->entry_provider)) {
            $this->withEntryProvider(BlogEntryProvider::class);
        }

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
    public function withPublicPath(string $path): BlogContract
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

    /**
     * Set the entry provider instance
     *
     * @param string|BlogEntryProvider $provider
     * @return $this
     * @throws \Bjuppa\LaravelBlog\Exceptions\InvalidConfiguration
     */
    public function withEntryProvider($provider): BlogContract
    {
        if (is_string($provider)) {
            $provider = app()->make($provider);
        }

        InvalidConfiguration::throwIfInterfaceNotImplemented(BlogEntryProvider::class, $provider);

        $this->entry_provider = $provider;

        return $this;
    }

    /**
     * Get the blog's entry provider instance
     * @return BlogEntryProvider
     */
    public function getEntryProvider(): BlogEntryProvider
    {
        return $this->entry_provider;
    }
}
