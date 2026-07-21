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
        Schema::create('saas_leads', function (Blueprint $table) {
            $table->id();
            $table->string('lead_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->string('source')->default('manual');
            $table->string('stage')->default('new');
            $table->enum('is_active', ['active', 'inactive'])->default('active');
            $table->integer('score')->default(0);
            $table->text('notes')->nullable();
            // 👉 store ALL extra DTO fields properly
            $table->json('meta')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->foreign('assigned_to')->references('uid')->on('saas_users');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('uid')->on('saas_users');
            $table->timestamp('contacted_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->softDeletes();
            $table->index(['stage', 'source', 'assigned_to']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saas_leads');
    }
};
