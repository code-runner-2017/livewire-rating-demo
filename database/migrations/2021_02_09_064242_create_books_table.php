<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->integer('year')->nullable();
            $table->string('cover_url')->nullable();
            $table->string('first_sentence')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
        });

        Schema::create('book_user', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id')->references('id')->on('books');
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('rating')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
