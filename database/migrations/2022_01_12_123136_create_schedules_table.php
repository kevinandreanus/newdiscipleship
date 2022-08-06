<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->string('title');
            $table->dateTime('datetime');
            $table->dateTime('end_datetime');
            $table->unsignedBigInteger('pic');
            $table->string('meet_link')->nullable();
            $table->string('alternative_meet_link')->nullable();
            $table->string('address_address')->nullable();
            $table->string('address_description')->nullable();
            $table->string('address_link')->nullable();
            $table->string('description')->nullable();
            
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
        Schema::dropIfExists('schedules');
    }
}
