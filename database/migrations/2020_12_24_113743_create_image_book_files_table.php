<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageBookFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_book_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('library_id')->nullable();
            $table->string('name')->nullable();
            $table->float('size')->nullable();
            $table->string('path')->nullable();
            $table->string('ext')->nullable();
            $table->boolean('is_image')->nullable();
            $table->timestamps();
        });
        Schema::table('libraries', function (Blueprint $table) {
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_book_files');
    }
}
