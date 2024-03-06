<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraryBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('library_book', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('branches_id');
            $table->unsignedInteger('library_id');
            $table->unsignedInteger('item_category_id');
            $table->unsignedInteger('racks')->nullable();
            $table->unsignedInteger('author_id')->nullable();
            $table->unsignedInteger('tag_id')->nullable();
            $table->unsignedInteger('genre_id')->nullable();
            $table->unsignedInteger('subject_id')->nullable();
            $table->string('book_no')->nullable();
            $table->string('accession_no')->nullable();
            $table->string('ddc_no')->nullable();
            $table->string('barcode_no')->nullable();
            $table->longText('book_title');
            $table->longText('search_keyword')->nullable();
            $table->boolean('no_of_copy')->nullable();
            $table->boolean('pages')->nullable();
            $table->enum('book_condition',['good','damage','missing'])->default('good');
            $table->enum('issuable',['yes','no'])->default('yes');
            $table->string('edition')->nullable();
            $table->string('year')->nullable();
            $table->longText('publisher')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('shelf_no')->nullable();
            $table->string('price')->default(0)->nullable();
            $table->string('scan_copy')->nullable();
            $table->string('book_image')->nullable();
            $table->longText('e_book_url')->nullable();
            $table->string('source')->nullable();
            $table->string('bill_no')->nullable();
            $table->date('bill_date')->nullable();
            $table->decimal('cost')->default(0)->nullable();
            $table->longText('topic')->nullable();
            $table->longText('remark')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->enum('current_issue',['1','0'])->default(0);
            $table->string('entry_id')->nullable();
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
        Schema::dropIfExists('library_book');
    }
}
