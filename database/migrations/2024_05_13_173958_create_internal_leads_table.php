<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalLeadsTable extends Migration
{
    public function up()
    {
        Schema::create('internal_leads', function (Blueprint $table) {
            $table->id();
            $table->string('candidate_name');
            $table->string('candidate_email')->unique();
            $table->string('candidate_mobile');
            $table->text('candidate_interview_feedback')->nullable();
            $table->date('interview_date')->nullable();
            $table->string('status')->default('pending');
            $table->text('additional_comments')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('internal_leads');
    }
}
