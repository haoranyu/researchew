<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePapersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papers', function($table)
        {
            $table->string('id', 255);
            $table->string('hash', 40);
            $table->string('title', 255);
            $table->text('abstract')->nullable();
            $table->string('author', 255)->nullable();
            $table->integer('date');
            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('papers');
    }

}
