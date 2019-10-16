<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('orgs');

        Schema::create('orgs', function (Blueprint $table) {
            $table->nestedSet();

            $table->increments('id')->unique();
            $table->timestamps();

            $table->string('title');
            $table->string('description')->default('')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orgs');
    }
}
