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
        Schema::create('candidate_resumes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('candidate_id');
            $table->string('title');
            $table->string('resume');
            $table->text('cover_letter')->nullable();
            $table->timestamps();

            $table->index('candidate_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidate_resumes');
    }
};
