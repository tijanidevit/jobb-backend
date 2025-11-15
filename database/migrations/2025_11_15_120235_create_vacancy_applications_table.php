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
        Schema::create('vacancy_applications', function (Blueprint $table) {
        $table->uuid('id')->primary();

        $table->foreignUuid('vacancy_id');
        $table->foreignUuid('candidate_id');

        $table->string('resume');
        $table->text('cover_letter')->nullable();
        $table->string('status')->default('pending');

        $table->unique(['vacancy_id', 'candidate_id']);

        $table->index('vacancy_id');
        $table->index('candidate_id');

        $table->index(['vacancy_id', 'status']);
        $table->index(['candidate_id', 'status']);

        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
