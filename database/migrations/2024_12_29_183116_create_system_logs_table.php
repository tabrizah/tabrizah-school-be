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
    Schema::create('system_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
        $table->string('type', 50);
        $table->string('action');
        $table->string('entity_type');
        $table->unsignedBigInteger('entity_id')->nullable();
        $table->text('description')->nullable();
        $table->json('metadata');
        $table->string('status', 50);
        $table->timestamps();
        
        $table->index(['type', 'created_at']);
        $table->index(['entity_type', 'entity_id']);
        $table->index('user_id');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_logs');
    }
};
