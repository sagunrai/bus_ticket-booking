<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBustypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bustypes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('map');
            $table->string('seats')->nullable();
            $table->integer('n_row')->default(0);
            $table->integer('n_col')->default(0);
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
        Schema::dropIfExists('bustypes');
    }
}
