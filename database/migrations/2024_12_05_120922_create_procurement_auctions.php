<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('procurement_auctions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('slug', 40)->unique();
            $table->enum('mode', ['PPBJ', 'POKJA'])->default('PPBJ');
            $table->foreignId('type_id');
            $table->foreignId('method_id');
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
            $table->foreignId('officer_id')->nullable();
            $table->foreignId('workgroup_id')->nullable();
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
            $table->foreignId('drafted_by');
            $table->foreignId('submitted_by')->nullable();
            $table->foreignId('qualified_by')->nullable();
            $table->foreignId('rejected_by')->nullable();
            $table->foreignId('verified_by')->nullable();
            $table->foreignId('aborted_by')->nullable();
            $table->foreignId('evaluated_by')->nullable();
            $table->string('assignments')->nullable();
            $table->string('reviews')->nullable();
            $table->jsonb('documents')->nullable();
            $table->jsonb('reports')->nullable();
            $table->jsonb('logs')->nullable();
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
