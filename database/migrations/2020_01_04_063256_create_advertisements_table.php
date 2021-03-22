<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned();
            $table->integer('ad_size_id')->index()->unsigned();
            $table->integer('ad_colour_id')->index()->unsigned();
            $table->integer('ad_category_id')->index()->unsigned();
            $table->integer('ad_language_id')->index()->unsigned();
            $table->string('file_name');
            $table->dateTime('date');
            $table->text('link');
            $table->integer('price')->unsigned();
            $table->boolean('paid')->nullable();
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
        Schema::dropIfExists('advertisements');
    }
}
