<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subsidiary_quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subsidiary_id')->constrained()->onDelete('cascade');
            $table->foreignId('subsidiary_service_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->integer('quantity')->nullable();
            $table->text('requirements')->nullable();
            $table->string('attachment')->nullable();
            $table->string('status')->default('new');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subsidiary_quotes');
    }
};