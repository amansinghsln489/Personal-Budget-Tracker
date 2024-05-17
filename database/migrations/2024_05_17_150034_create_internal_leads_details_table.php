<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_leads_details', function (Blueprint $table) {
            $table->id('internal_leads_details_id');
            $table->unsignedBigInteger('lead_id');
            $table->text('comment')->nullable();
            $table->integer('interview_status')->nullable();
            $table->unsignedBigInteger('leadCreate_user_Id');
            $table->string('leadCreate_user_name')->nullable();
            $table->string('leadCreate_user_role')->nullable();
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('lead_id')->references('id')->on('internal_leads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internal_leads_details');
    }
};
