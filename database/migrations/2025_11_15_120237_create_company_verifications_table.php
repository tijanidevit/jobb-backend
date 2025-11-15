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

            $table->string('document_type'); // cac, id_card, utility_bill
            $table->string('document'); // file path of uploaded doc

            $table->string('status')->default('pending');
            // pending | approved | rejected

            $table->text('approval_note')->nullable();
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
