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
        Schema::create('procurement_biodatas', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('slug', 18)->unique();
            $table->string('section')->nullable();
            $table->string('position')->nullable();
            $table->foreignId('workgroup_id')->nullable();
            $table->enum('role', ['PPK', 'KASUBAG', 'KABAG', 'POKJA', 'ADMINISTRATOR', 'OPERATOR'])->index()->default('POKJA');
            $table->jsonb('meta')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procurement_biodatas');
    }
};
