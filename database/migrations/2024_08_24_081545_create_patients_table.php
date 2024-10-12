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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('age')->nullable();
            $table->string('doctor_id')->nullable();
            $table->string('ref_by_id')->nullable();
            $table->string('amount')->nullable();
            $table->mediumText('test');
            $table->string('amount_paid')->nullable();
            $table->string('amount_paid_online')->nullable();
            $table->string('amount_paid_cash')->nullable();
            $table->string('amount_due')->nullable();
            $table->string('rcless')->nullable();
            $table->string('test_status')->default('pending')->nullable()->comment('pending, completed, cancelled');
            $table->date('test_delivery_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
