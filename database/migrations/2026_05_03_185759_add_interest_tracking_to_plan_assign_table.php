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
        Schema::table('plan_assign', function (Blueprint $table) {
            $table->integer('total_interests')->default(0)->after('plan_end_date');
            $table->integer('used_interests')->default(0)->after('total_interests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan_assign', function (Blueprint $table) {
            $table->dropColumn(['total_interests', 'used_interests']);
        });
    }
};
