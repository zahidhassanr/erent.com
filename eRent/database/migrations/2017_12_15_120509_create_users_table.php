<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->String('name');
            $table->String('email')->unique();
            $table->String('password');
            $table->String('address');
            $table->Integer('phone');
            $table->Integer('isCustomer')->default(0);
            $table->Integer('isOwner')->default(0);
            $table->Integer('property_uploaded')->default(0);
            $table->Integer('property_chosen')->default(0);
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
        Schema::dropIfExists('users');
    }
}
