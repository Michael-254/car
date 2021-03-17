<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('response_id');
            $table->unsignedBigInteger('hod_id')->nullable();
            $table->unsignedBigInteger('followup_id')->nullable();
            $table->string('date');
            $table->string('number');
            $table->string('auditor');
            $table->string('auditee');
            $table->string('site');
            $table->string('department');
            $table->string('clause');
            $table->string('checkbox');
            $table->text('report');
            $table->string('status')->default('pending');
            $table->string('response_date')->nullable();
            $table->string('hod_date')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('audits');
    }
}
