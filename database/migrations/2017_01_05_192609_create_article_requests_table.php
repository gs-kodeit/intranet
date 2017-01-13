<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->text('article_name');
            $table->string('usage');
            $table->boolean('generic')->default(false);
            $table->string('unit');
            $table->text('explanation');
            $table->integer('department_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->boolean('created')->default(false);
            $table->boolean('sent')->default(false);
            $table->string('cod_art',8)->nullable();
            $table->string('des_art')->nullable();
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
        Schema::dropIfExists('article_requests');
    }
}
