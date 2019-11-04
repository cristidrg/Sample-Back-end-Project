<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedOrgsUsersPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orgs_users', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('org_id')->unsigned();
            $table->primary(['user_id', 'org_id'], 'orgs_users_primary');
            $table->timestamps();
        });

        Schema::table('orgs_users', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->foreign('org_id')->references('id')->on('orgs')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orgs_users');
    }
}
