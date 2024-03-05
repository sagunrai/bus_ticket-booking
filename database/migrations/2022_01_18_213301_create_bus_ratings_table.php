<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bus_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('rating')->default(0);
            $table->longtext('review')->nullable();
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('SET NULL')->nullable();
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
        Schema::dropIfExists('bus_ratings');
    }
}
