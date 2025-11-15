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
        Schema::create('company_verifications', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('company_id');

            $table->string('document_type');
            $table->string('document');

            $table->string('status')->default('pending');

            $table->text('approval_note')->nullable();

            $table->index('company_id');
            $table->index(['company_id', 'document_type']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_verifications');
    }
};
