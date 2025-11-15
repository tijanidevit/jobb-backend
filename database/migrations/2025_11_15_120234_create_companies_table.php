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
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('user_id');

            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->string('industry')->nullable();
            $table->text('description')->nullable();

            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();

            $table->boolean('is_verified')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
