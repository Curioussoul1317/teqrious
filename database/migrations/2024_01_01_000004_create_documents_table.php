<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type');
            $table->bigInteger('file_size');
            $table->enum('visibility', ['admin_only', 'client_visible'])->default('client_visible');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['project_id', 'visibility']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
