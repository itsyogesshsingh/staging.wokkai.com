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
        Schema::create('saas_modules', function (Blueprint $table) {
            $table->id('module_id');
            $table->string('module_name', 100)->nullable();
            $table->string('module_slug')->nullable()->unique();
            $table->string('module_type')->nullable(); // CRM / HRM / CORE
            $table->enum('status', ['active', 'inactive'])->nullable()->default('inactive');
            $table->tinyInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saas_modules');
    }
};
