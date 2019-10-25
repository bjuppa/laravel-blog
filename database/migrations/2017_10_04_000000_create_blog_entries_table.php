<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogEntriesTable extends Migration
{
    /**
     * Name of the Eloquent blog entry model table
     * @var string
     */
    protected $model_table_name;

    /**
     * The default blog identifier for new entries
     * @var string
     */
    protected $default_blog_id = 'main';

    /**
     * CreateBlogEntriesTable constructor.
     */
    public function __construct()
    {
        $model = app(\Bjuppa\LaravelBlog\Eloquent\AbstractBlogEntry::class);
        $this->model_table_name = $model->getTable();
        $this->connection = $model->getConnectionName();

        // Taking the first blog id from the config if available
        $blogs = config('blog.blogs');
        if (is_array($blogs)) {
            reset($blogs);
            $this->default_blog_id = key($blogs);
        }
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->model_table_name, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('blog')->default($this->default_blog_id);
            $table->timestamp('publish_after')->nullable();
            $table->string('slug');
            $table->string('title');
            $table->string('author_name')->nullable();
            $table->string('author_email')->nullable();
            $table->string('author_url')->nullable();
            $table->text('image')->nullable();
            $table->text('content');
            $table->text('summary')->nullable();
            $table->string('page_title')->nullable();
            $table->string('description')->nullable();
            $table->json('meta_tags')->nullable();
            $table->boolean('display_full_content_in_feed')->nullable();
            $table->timestamps();

            $table->unique(['slug', 'blog'], 'slug');
            $table->index(['publish_after', 'blog', 'slug'], 'public');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->model_table_name);
    }
}
