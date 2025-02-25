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
        Schema::create('procurement_auctions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('slug', 40)->unique();

            $table->enum('type', [
                'CONSTRUCTION',
                'NONE-CONSTRUCTION'
            ])->index()->default('NONE-CONSTRUCTION');

            $table->enum('method', [
                'DIKECUALIKAN',
                'E-PURCHASING',
                'TENDER',
                'TENDER-CEPAT',
                'PENGADAAN-LANGSUNG',
                'PENUNJUKAN-LANGSUNG'
            ])->index()->default('E-PURCHASING');

            $table->tinyInteger('month')->index();
            $table->smallInteger('year')->index();

            $table->enum('source', [
                'APBN',
                'APBNP',
                'APBD',
                'APBDP',
                'PHLN',
                'PNBP',
                'BUMN',
                'BUMD'
            ])->index()->default('APBD');

            $table->double('ceiling')->default(0);
            $table->double('realization')->default(0);
            $table->foreignId('workunit_id');
            $table->string('workunit_name');

            $table->enum('status', [
                'DRAFTED',
                'SUBMITTED',
                'REJECTED',
                'QUALIFIED',
                'VERIFIED',
                'ABORTED',
                'SIGNED',
                'SHIFTED',
                'EVALUATED',
                'CONFIRMED',
                'REPORTED',
                'COMPLETED'
            ])->index()->default('DRAFTED');

            $table->foreignId('submitted_by');
            $table->foreignId('qualified_by');
            $table->foreignId('verified_by');
            $table->foreignId('evaluated_by');

            $table->string('assignments')->nullable();
            $table->string('reviews')->nullable();
            $table->jsonb('documents')->nullable();
            $table->jsonb('reports')->nullable();
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
        Schema::dropIfExists('procurement_auctions');
    }
};
