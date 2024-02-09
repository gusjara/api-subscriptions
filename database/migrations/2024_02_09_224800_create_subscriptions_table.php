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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            // foreigns
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')->references('id')->on('properties');

            $table->unsignedBigInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on('plans');

            $table->string('payment_type')->comment('debit | card');
            $table->boolean('status');
            $table->date('init_date');
            $table->date('end_date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
