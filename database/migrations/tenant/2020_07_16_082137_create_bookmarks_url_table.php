<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookmarksUrlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmarks_url', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('ac_user_id');
            $table->unsignedInteger('bookmarks_category_id')->nullable();
            $table->boolean('position')->default(0);
            $table->string('icon')->nullable();
            $table->longText('title')->nullable();
            $table->longText('alias')->nullable();
            $table->longText('url')->nullable();
            $table->enum('open_window',['_self','_blank','_parent','_top'])->default('_self');
            $table->enum('is_active',[1,0])->default(1);
            $table->unsignedInteger('user_id');
            $table->softDeletes();
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
        Schema::dropIfExists('bookmarks_url');
    }
}
