<?php

use App\Models\Project;
use App\Models\Service;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Service::class)->constrained(); // 'service_id',
            $table->foreignIdFor(Project::class)->constrained(); // 'project_id',
            $table->text('other_description')->nullable();       // 'other_description',
            $table->string('is_new_task')->nullable();           // 'is_new_task',
            $table->string('is_new_task_override')->nullable();  // 'is_new_task_override',
            $table->float('price')->nullable();                  // 'price',
            $table->float('price_override')->nullable();         // 'price_override',
            $table->float('price_total')->nullable();            // 'price_total',
            $table->float('expense_override')->nullable();       // 'expense_override',
            $table->float('expense_total')->nullable();          // 'expense_total',
            $table->text('design_revision_scope')->nullable();   // 'design_revision_scope',
            $table->text('new_storage_design')->nullable();      // 'new_storage_design',
            $table->text('notes')->nullable();                   // 'notes',
            $table->string('task_status')->nullable();           // 'task_status',
            $table->dateTime('date_completed')->nullable();      // 'date_completed',
            $table->dateTime('date_cancelled')->nullable();      // 'date_cancelled',
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
