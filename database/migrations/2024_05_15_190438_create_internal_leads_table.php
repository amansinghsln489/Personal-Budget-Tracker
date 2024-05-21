<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_leads', function (Blueprint $table) {
            $table->id();
            $table->string('candidate_name');
            $table->string('candidate_email');
            $table->string('candidate_mobile');
            $table->string('interviewee_id');
            $table->string('technology_id');
            $table->string('created_by');
            $table->string('image')->nullable();
            $table->string('resume')->nullable();
            $table->string('experience')->nullable();
            $table->text('candidate_interview_feedback')->nullable();
            $table->dateTime('interview_date')->nullable();
            $table->string('status')->default('pending');
            $table->text('additional_comments')->nullable();
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
        Schema::dropIfExists('internal_leads');
    }
}
