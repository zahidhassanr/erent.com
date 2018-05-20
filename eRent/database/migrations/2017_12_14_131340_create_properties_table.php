<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->String('imageUrl');
            $table->String('name');
            $table->String('description');
            $table->Integer('bedrooms')->default(0);
            $table->Integer('drawingrooms')->default(0);
            $table->Integer('diningrooms')->default(0);
            $table->Integer('toilet')->default(0);
            $table->Integer('price');
            $table->Integer('servicecharge')->default(0);
            $table->Integer('area');
            $table->boolean('parking')->default(0);
            $table->float('x_coordinate');
            $table->float('y_coordinate');
            $table->String('district');
            $table->String('location');
            $table->String('property_type');
            $table->String('sale_type');
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
        Schema::dropIfExists('properties');
    }
}
