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
        if (Schema::hasTable('free_user')) {
            Schema::table('free_user', function (Blueprint $table) {
                if (!Schema::hasColumn('free_user', 'remember_token')) {
                    $table->rememberToken()->after('password');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('free_user')) {
            Schema::table('free_user', function (Blueprint $table) {
                if (Schema::hasColumn('free_user', 'remember_token')) {
                    $table->dropRememberToken();
                }
            });
        }
    }
};
