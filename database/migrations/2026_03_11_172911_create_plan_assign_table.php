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
        if (!Schema::hasTable('plan_assign')) {
            Schema::create('plan_assign', function (Blueprint $table) {
                $table->id();
                $table->integer('member_id')->unique();
                $table->integer('plan_id');
                $table->date('plan_start_date');
                $table->date('plan_end_date');
                $table->string('plan_status', 20)->default('Active'); // or Expired
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_assign');
    }
};
