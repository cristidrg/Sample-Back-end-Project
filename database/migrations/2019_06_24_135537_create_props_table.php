<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('props', function (Blueprint $table) {
            $table->nestedSet();

            $table->increments('id');
            $table->timestamps();

            $table->string('title');
            $table->string('description');
            $table->string('url')->unique();

            $table->float('perfScore')->default('0');
            $table->float('a11yScore')->default('0');
            $table->float('seoScore')->default('0');
            $table->string('fetchTime')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('props');
    }
}
