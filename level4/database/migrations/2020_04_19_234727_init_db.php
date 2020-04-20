<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitDb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('book');
            $table->string('authors');
            $table->integer('year')->unsigned();
            $table->string('preview')->nullable();
            $table->integer('clicks')->default(0);
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('login')->unique();
            $table->string('pass');
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
        Schema::dropIfExists('admins');
    }
}
