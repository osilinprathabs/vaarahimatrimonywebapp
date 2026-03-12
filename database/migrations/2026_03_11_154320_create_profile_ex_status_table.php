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
        if (!Schema::hasTable('profile_ex_status')) {
            Schema::create('profile_ex_status', function (Blueprint $table) {
                $table->id();
                $table->string('expire_status')->nullable(); // 'date', 'month', 'year'
                $table->integer('count')->nullable();        // number of days/months/years
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_ex_status');
    }
};
