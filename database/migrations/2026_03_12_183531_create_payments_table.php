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
        if (!Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id();
                $table->integer('member_id');
                $table->decimal('amount', 10, 2);
                $table->string('transaction_id')->nullable();
                $table->string('payment_method')->nullable();
                $table->string('status')->default('Pending');
                $table->date('payment_date')->nullable();
                $table->integer('plan_id')->nullable();
                $table->text('remarks')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
