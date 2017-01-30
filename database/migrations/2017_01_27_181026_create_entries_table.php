<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('operation');
            $table->string('type');
            $table->string('destination');
            $table->time('time');
            $table->string('person_name')->nullable();
            $table->string('person_id')->nullable();
            $table->string('person_occupation')->nullable();
            $table->string('vehicle')->nullable();
            $table->string('vehicle_plate')->nullable();
            $table->string('material_type')->nullable();
            $table->decimal('material_quantity',9,2)->nullable();
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('entries');
    }
}
