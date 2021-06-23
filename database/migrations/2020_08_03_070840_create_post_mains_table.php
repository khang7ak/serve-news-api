<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostMainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postMains', function (Blueprint $table) {
            $table->increments('id');
            $table->text('post_title');
            $table->text('post_category');
            $table->string('post_sub')->nullable();
            $table->string('post_content')->nullable();
            $table->tinyInteger('test')->nullable();
            $table->tinyInteger('post_sub_1')->nullable();
            $table->tinyInteger('post_sub_2')->nullable();
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
        Schema::dropIfExists('postMains');
    }
}
