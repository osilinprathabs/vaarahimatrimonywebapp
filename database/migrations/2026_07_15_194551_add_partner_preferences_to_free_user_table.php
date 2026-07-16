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
        Schema::table('free_user', function (Blueprint $table) {
            $table->integer('expected_min_age')->nullable()->after('expectation');
            $table->integer('expected_max_age')->nullable()->after('expected_min_age');
            $table->string('expected_marital_status')->nullable()->after('expected_max_age');
            $table->integer('expected_caste')->nullable()->after('expected_marital_status');
            $table->string('expected_education')->after('expected_caste')->nullable();
            $table->string('expected_monthly_income')->after('expected_education')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('free_user', function (Blueprint $table) {
            $table->dropColumn([
                'expected_min_age',
                'expected_max_age',
                'expected_marital_status',
                'expected_caste',
                'expected_education',
                'expected_monthly_income'
            ]);
        });
    }
};
