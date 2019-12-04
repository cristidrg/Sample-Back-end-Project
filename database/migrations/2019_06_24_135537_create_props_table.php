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
            $table->longText('environments')->nullable();
            $table->string('siteImproveId')->unique()->nullable();

            $table->float('perfScore')->default('0');
            $table->float('a11yScore')->default('0');
            $table->float('seoScore')->default('0');
            $table->float('qaScore')->default('0');
            $table->float('securityScore')->default('0');
            $table->string('fetchTime')->default('0');

            $table->longText('metaTitle')->nullable();
            $table->longText('metaDesc')->nullable();

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
