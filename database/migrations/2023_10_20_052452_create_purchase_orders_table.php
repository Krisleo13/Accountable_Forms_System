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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->integer("sup_id");
            $table->string("po_no");
            $table->integer("status");
            $table->integer("term");
            $table->string("Requesters");
            $table->string("branch");
            $table->text("remarks");
            $table->string("prepared_by");
            $table->integer("approved_by")->nullable();
            $table->dateTime('date_approved')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
