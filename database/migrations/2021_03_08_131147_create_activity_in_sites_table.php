<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityInSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_in_sites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_in_weeks_id');
            $table->foreign('site_in_weeks_id')->references('id')->on('site_in__weeks');
            $table->unsignedBigInteger('todos');
            $table->boolean('checked')->default(false);
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
        Schema::dropIfExists('activity_in_sites');
    }
}
