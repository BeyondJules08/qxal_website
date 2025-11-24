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
        Schema::create('game_files', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->string('version');
            $table->string('platform')->default('PC'); // PC, Mac, Linux
            $table->boolean('is_active')->default(false);
            $table->unsignedBigInteger('download_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_files');
    }
};
