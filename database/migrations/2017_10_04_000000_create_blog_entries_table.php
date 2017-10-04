<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogEntriesTable extends Migration
{
    /**
     * @var string name of the Eloquent blog entry model table
     */
    private $model_table_name;

    /**
     * CreateBlogEntriesTable constructor.
     */
    public function __construct()
    {
        $this->model_table_name = (new \Bjuppa\LaravelBlog\Eloquent\BlogEntry())->getTable();
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
            $table->timestamps();
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
