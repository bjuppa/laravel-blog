<?php

namespace Bjuppa\LaravelBlog;

use Bjuppa\LaravelBlog\Contracts\Blog as BlogContract;
use Bjuppa\LaravelBlog\Contracts\BlogEntry;
use Bjuppa\LaravelBlog\Contracts\BlogEntryProvider;
use Illuminate\Support\Collection;

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
    protected $public_path;

    /**
     * The number of entries to display in "latest" listings
     * @var int
     */
    protected $latest_entries_limit = 5;

    /**
     * Instance of a blog entry provider to pull blog entries from
     * @var BlogEntryProvider
     */
    protected $entry_provider;

    /**
     * The domain where this blog resides
     * @var string|null
     */
    protected $domain;

    /**
     * Blog constructor.
     *
     * @param string $blog_id
     * @param BlogEntryProvider $provider
     * @param iterable $configuration
     */
    public function __construct(string $blog_id, BlogEntryProvider $provider, iterable $configuration = [])
    {
        $this->id = $blog_id;
        $this->withPublicPath('blog/' . $blog_id);
        $this->withEntryProvider($provider);

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
                trigger_error("Configuration problem for Blog '".$this->getId()."', config key '${config_name}': ".$e->getMessage(), E_USER_WARNING);
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
     * @param BlogEntryProvider $provider
     * @return $this
     */
    public function withEntryProvider(BlogEntryProvider $provider): BlogContract
    {
        $provider->withBlogId($this->getId());
        $this->entry_provider = $provider;

        return $this;
    }

    /**
     * Get the blog's entry provider instance
     *
     * @return BlogEntryProvider
     */
    public function getEntryProvider(): BlogEntryProvider
    {
        return $this->entry_provider;
    }

    /**
     * Prefix a route name for this blog
     *
     * @param string $name If empty, only the prefix is returned
     * @return string
     */
    public function prefixRouteName(string $name = ''): string
    {
        return implode('.', [config('blog.route_name_prefix', 'blog'), $this->getId(), $name]);
    }

    /**
     * Get an entry instance from a slug
     *
     * @param string $slug
     * @return BlogEntry|null
     */
    public function findEntry(string $slug): ?BlogEntry
    {
        return $this->getEntryProvider()->findBySlug($slug);
    }

    /**
     * Get the newest entries of the blog
     *
     * @param int|null $limit Desired number of entries unless you want the blog's default
     * @return Collection
     */
    public function latestEntries(int $limit = null): Collection
    {
        return $this->getEntryProvider()->latest($limit ?? $this->getLatestEntriesLimit());
    }

    /**
     * Get the number of default entries to show
     *
     * @return int
     */
    public function getLatestEntriesLimit(): int
    {
        return $this->latest_entries_limit;
    }

    /**
     * Set the number of default entries to show
     *
     * @param int $limit
     * @return BlogContract
     */
    public function withLatestEntriesLimit(int $limit): BlogContract
    {
        $this->latest_entries_limit = $limit;

        return $this;
    }

    /**
     * Set a specific domain for this blog
     *
     * @param string $domain
     * @return BlogContract
     */
    public function withDomain(string $domain): BlogContract
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get the domain for this blog
     *
     * @return string|null
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }
}
