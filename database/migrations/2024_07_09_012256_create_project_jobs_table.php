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
        Schema::create('project_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('project_id')->nullable();
            $table->string('job_name')->nullable();
            $table->string('service_order_url')->nullable();
            $table->string('request_no')->nullable();
            $table->string('job_no')->nullable();
            $table->string('service_order_form')->nullable();
            $table->string('job_status')->nullable();
            $table->string('in_review')->nullable();
            $table->string('estimated_completion')->nullable();
            $table->string('estimated_completion_override')->nullable();
            $table->dateTime('date_received_formula')->nullable();
            $table->dateTime('date_due')->nullable();
            $table->dateTime('date_completed')->nullable();
            $table->dateTime('date_cancelled')->nullable();
            $table->dateTime('date_sent')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_email_override')->nullable();
            $table->string('deliverables_email')->nullable();
            $table->text('additional_info')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
