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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignId('company_id');

            $table->string('title');
            $table->string('slug')->unique();

            $table->fullText('description');
            $table->string('location');
            $table->string('type'); // full_time, remote, contract, hybrid, internship

            $table->integer('salary_min')->nullable();
            $table->integer('salary_max')->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamp('expires_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
