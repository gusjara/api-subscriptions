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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // foreigns
            // $table->unsignedBigInteger('subscription_id');
            // $table->foreign('subscription_id')->references('id')->on('subscriptions');

            $table->string('lote');
            $table->string('status')->comment('generado | enviado_a_cobrar | pagado');
            $table->string('period_sufix')->comment('sufijo para hacer busquedas ej: mm-yyyy');
            $table->date('period_start');
            $table->date('period_end');
            $table->date('generate_date');
            $table->date('send_to_pay_date')->nullable();
            $table->date('paid_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
