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
        Schema::table('vacancies', function (Blueprint $table) {
            // salary currency, level, work_mode, json requirements, json benefits
            $table->string('category')->nullable();
            $table->string('salary_currency')->nullable();
            $table->string('level')->nullable();
            $table->string('work_mode')->nullable();
            $table->json('requirements')->nullable();
            $table->json('benefits')->nullable();
            $table->json('questions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vacancies', function (Blueprint $table) {
            $table->dropColumn([
                'category',
                'salary_currency',
                'level',
                'work_mode',
                'requirements',
                'benefits',
                'questions',
            ]);
        });
    }
};
