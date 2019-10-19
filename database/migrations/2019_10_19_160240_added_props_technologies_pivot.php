<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedPropsTechnologiesPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('props_technologies', function (Blueprint $table) {
            $table->integer('prop_id')->unsigned();
            $table->integer('technology_id')->unsigned();
            $table->primary(['prop_id', 'technology_id'], 'props_technologies_primary');
            $table->timestamps();
        });

        Schema::table('props_technologies', function (Blueprint $table) {
            $table->foreign('prop_id')->references('id')->on('props')->onDelete('cascade');;
            $table->foreign('technology_id')->references('id')->on('technologies')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('props_technologies');
    }
}
