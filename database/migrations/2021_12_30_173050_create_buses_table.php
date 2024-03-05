<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('bustype')->nullable();
            $table->unsignedBigInteger('busroute')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('bustype')->references('id')->on('bustypes')->onDelete('SET NULL');
            $table->foreign('busroute')->references('id')->on('categories')->onDelete('SET NULL');
            $table->time('departuretime');
            $table->time('arrivaltime');
            $table->double('persitprice')->default(0);
            $table->double('after_discount')->default(0);
            $table->double('persitpricedisper')->default(0);
            $table->string('image');
            $table->integer('sunday')->default(0);
            $table->integer('monday')->default(0);
            $table->integer('tuesday')->default(0);
            $table->integer('wednesday')->default(0);
            $table->integer('thursday')->default(0);
            $table->integer('friday')->default(0);
            $table->integer('saturday')->default(0);
            $table->enum('status',['active','inactive'])->default('active');
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
        Schema::dropIfExists('buses');
    }
}
