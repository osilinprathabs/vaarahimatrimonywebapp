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
        // Add register_id to free_user if it doesn't exist
        if (Schema::hasTable('free_user') && !Schema::hasColumn('free_user', 'register_id')) {
            Schema::table('free_user', function (Blueprint $table) {
                $table->string('register_id', 50)->nullable()->after('id');
            });
        }

        // Add timestamps to profile_images if they don't exist
        if (Schema::hasTable('profile_images') && !Schema::hasColumn('profile_images', 'created_at')) {
            Schema::table('profile_images', function (Blueprint $table) {
                $table->timestamps();
            });
        }

        // Add caste_id to subcaste if it doesn't exist
        if (Schema::hasTable('subcaste') && !Schema::hasColumn('subcaste', 'caste_id')) {
            Schema::table('subcaste', function (Blueprint $table) {
                $table->integer('caste_id')->nullable()->after('id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('free_user') && Schema::hasColumn('free_user', 'register_id')) {
            Schema::table('free_user', function (Blueprint $table) {
                $table->dropColumn('register_id');
            });
        }

        if (Schema::hasTable('profile_images')) {
            Schema::table('profile_images', function (Blueprint $table) {
                $table->dropTimestamps();
            });
        }

        if (Schema::hasTable('subcaste') && Schema::hasColumn('subcaste', 'caste_id')) {
            Schema::table('subcaste', function (Blueprint $table) {
                $table->dropColumn('caste_id');
            });
        }
    }
};
