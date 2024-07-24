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
        Schema::create('country_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->references('id')->on('countries')->cascadeOnDelete();
            $table->string('name');
            $table->boolean('is_preferred')->default(true);
            $table->boolean('is_short')->default(false);
            $table->boolean('is_colloquial')->default(false);
            $table->boolean('is_historic')->default(false);
            $table->string('locale', 24)->nullable();
            $table->integer('alternate_name_id')->unsigned()->nullable()->unique()->comment('Geonames database identifier');
            $table->timestamps();

            $table->index(['country_id', 'locale']);
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_translations');
    }
};
