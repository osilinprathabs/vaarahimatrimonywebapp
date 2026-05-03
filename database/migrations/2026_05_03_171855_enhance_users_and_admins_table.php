<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update free_user table
        Schema::table('free_user', function (Blueprint $table) {
            if (!Schema::hasColumn('free_user', 'temp_password')) {
                $table->string('temp_password')->nullable()->after('password');
            }
            if (!Schema::hasColumn('free_user', 'role')) {
                $table->string('role')->default('customer')->after('temp_password');
            }
        });

        // Update admin table to support roles and hashed passwords
        Schema::table('admin', function (Blueprint $table) {
            $table->string('password', 255)->change();
            if (!Schema::hasColumn('admin', 'role')) {
                $table->string('role')->nullable()->after('user_type');
            }
        });

        // Seed roles and hash existing admin passwords
        DB::table('admin')->get()->each(function ($admin) {
            $role = 'staff';
            if ($admin->user_type == 1) {
                $role = 'admin';
            }
            
            DB::table('admin')->where('admin_id', $admin->admin_id)->update([
                'role' => $role,
                'password' => Hash::make($admin->password)
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('free_user', function (Blueprint $table) {
            $table->dropColumn(['temp_password', 'role']);
        });
        Schema::table('admin', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
