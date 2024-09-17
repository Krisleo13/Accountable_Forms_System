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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->string('req_no');
            $table->string('branch_to');
            $table->string('attn');
            $table->string('branch_from');
            $table->integer('status');
            $table->string('prepared_by');
            $table->string('noted_by')->nullable();
            $table->dateTime('date_noted')->nullable();
            $table->string('approved_by')->nullable();
            $table->dateTime('date_approved')->nullable();
            $table->text('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitions');
    }
};
