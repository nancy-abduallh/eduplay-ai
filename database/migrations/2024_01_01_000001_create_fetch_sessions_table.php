<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fetch_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('pending');
            $table->json('categories');
            $table->unsignedInteger('total_categories')->default(0);
            $table->unsignedInteger('processed_categories')->default(0);
            $table->unsignedInteger('total_found')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fetch_sessions');
    }
};
