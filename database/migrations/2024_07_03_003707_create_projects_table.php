<?php

use App\Models\Client;
use App\Models\User;
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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Client::class)->constrained();
            $table->string('project_number');
            $table->string('property_type')->nullable(); // 'property_type',
            $table->string('property_owner_name')->nullable(); // 'property_owner_name',
            $table->text('property_address')->nullable(); // 'property_address',
            $table->string('property_state')->nullable(); // 'property_state',
            $table->string('property_city')->nullable(); // 'property_city',
            $table->string('property_area_code')->nullable(); // 'property_area_code',
            $table->string('wet_stamp_mailing_address')->nullable(); // 'wet_stamp_mailing_address',
            $table->string('wet_stamp_count')->nullable(); // 'wet_stamp_count',
            $table->string('shipping_number')->nullable(); // 'shipping_number',
            $table->string('priority_level')->nullable(); // 'priority_level',
            $table->string('task_price_total')->nullable(); // 'task_price_total',
            $table->string('commercial_job_price')->nullable(); // 'commercial_job_price',
            $table->string('task_total')->nullable(); // 'total',
            $table->text('rfi_messages')->nullable(); // 'rfi_messages',
            $table->foreignIdFor(User::class, 'created_by'); // 'created_by',
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
