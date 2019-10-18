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
        Schema::dropIfExists('props');

        Schema::create('props', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->timestamps();

            $table->string('title');
            $table->string('url')->unique();

            $table->float('perfScore')->default('0');
            $table->float('a11yScore')->default('0');
            $table->float('seoScore')->default('0');
            $table->string('fetchTime')->default('0');

            $table->integer('org_id')->unsigned()->index()->nullable();
            $table->foreign('org_id')->references('id')->on('orgs')->onDelete('cascade');
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
