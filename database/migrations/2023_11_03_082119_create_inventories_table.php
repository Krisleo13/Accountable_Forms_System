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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('dr_no');
            $table->integer('ol_id');
            $table->integer('quantity');
            $table->integer('set_qty');
            $table->integer('set_per_item');
            $table->integer('item_id');
            $table->integer('booklet');
            $table->integer('series_start');
            $table->integer('series_end');
            $table->integer('location');
            $table->integer('assignee');
            $table->integer('receiving_ol_id');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
