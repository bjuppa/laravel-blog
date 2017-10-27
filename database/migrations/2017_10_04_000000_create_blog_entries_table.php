<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
        $this->model_table_name = (new \Bjuppa\LaravelBlog\Eloquent\BlogEntry())->getTable();

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
            $table->increments('id');
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
            $table->timestamps();

            $table->index('blog', 'blog');
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
