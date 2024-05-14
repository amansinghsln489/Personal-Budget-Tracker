<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('technology_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('interviewee_id')->nullable();
            $table->dateTime('interview_date')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullable();
            $table->decimal('company_rate', 10, 2)->nullable();
            $table->string('interview_status')->nullable();
            $table->text('lead_comment')->nullable();
            $table->string('meeting_link')->nullable();
            $table->string('source')->nullable();
            $table->unsignedBigInteger('lead_created_user_id');
            $table->string('lead_created_user_role');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
