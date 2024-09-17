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
        //
        Schema::create("receivings", function (Blueprint $table) {
            $table->id();
            $table->string('dr_no');
            $table->integer('source');
            $table->integer('sender');
            $table->integer('receiver');
            $table->integer('status');
            $table->text('remarks');
            $table->string('prepared_id');
            $table->string('approved_id')->nullable();
            $table->dateTime('approved_date')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
         Schema::dropIfExists('receivings');
    }
};
