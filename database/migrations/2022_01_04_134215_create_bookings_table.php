<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('pname');
            $table->string('pemail')->nullable();
            $table->string('pphone');
            $table->string('pgender');
            $table->string('page')->nullable();
            $table->string('paied_amount')->default(0);
            $table->longText('map');
            $table->date('bookingdate')->nullable();
            $table->unsignedBigInteger('bus_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('SET NULL')->nullable();
            $table->time('departuretime')->nullable();
            $table->time('arrivaltime')->nullable();
            $table->string('payment')->nullable();
            $table->enum('status',['active','inactive','cancelled'])->default('inactive');
            $table->string('payment_from')->default('esewa');
            $table->string('payment_amount')->default('0');
            $table->timestamp('payment_time')->nullable();
            $table->timestamp('inactive_time')->nullable();
            $table->string('ticket_number')->unique()->nullable();
            $table->string('boading_point')->nullable();
            $table->string('remark')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('bookings');
    }
}
