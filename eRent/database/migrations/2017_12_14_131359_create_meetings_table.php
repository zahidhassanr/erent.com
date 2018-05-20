<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('meeting_id');
            $table->Integer('customer_id');
            $table->Integer('customer_phone');
            $table->Integer('owner_id');
            $table->Integer('owner_phone');
            $table->Integer('employee_id');
            $table->Integer('properties_id');
            $table->date('meeting_date');
            $table->time('meeting_time');
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
        Schema::dropIfExists('meetings');
    }
}
