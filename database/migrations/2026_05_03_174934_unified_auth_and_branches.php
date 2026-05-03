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
        // 1. Create temple_branches table
        if (!Schema::hasTable('temple_branches')) {
            Schema::create('temple_branches', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('location')->nullable();
                $table->string('contact_no')->nullable();
                $table->timestamps();
            });
            
            // Seed a default branch
            DB::table('temple_branches')->insert([
                ['name' => 'Main Branch', 'location' => 'Head Office', 'created_at' => now()],
                ['name' => 'North Branch', 'location' => 'North Region', 'created_at' => now()],
            ]);
        }

        // 2. Enhance free_user table for unified auth
        Schema::table('free_user', function (Blueprint $table) {
            if (!Schema::hasColumn('free_user', 'role')) {
                $table->string('role')->default('customer')->after('password');
            }
            if (!Schema::hasColumn('free_user', 'branch_id')) {
                $table->unsignedBigInteger('branch_id')->nullable()->after('role');
            }
            // Ensure username/user_id can be used
            if (!Schema::hasColumn('free_user', 'username')) {
                $table->string('username')->nullable()->unique()->after('name');
            }
        });

        // 3. Migrate Admin data to free_user
        if (Schema::hasTable('admin')) {
            $admins = DB::table('admin')->get();
            foreach ($admins as $admin) {
                // Check if user already exists by user_id
                $exists = DB::table('free_user')->where('username', $admin->user_id)->exists();
                if (!$exists) {
                    $role = ($admin->user_type == 1) ? 'admin' : 'staff';
                    
                    DB::table('free_user')->insert([
                        'username' => $admin->user_id,
                        'name'     => ucfirst($admin->user_id),
                        'emailid'  => $admin->user_id,
                        'password' => $admin->password,
                        'role'     => $role,
                        'status'   => 1,
                        'date'     => date('Y-m-d'),
                        'userid'   => 'ADM' . rand(1000, 9999),
                        'register_id' => 'REGADM' . rand(100, 999),
                        'mid'      => 'MID' . rand(100, 999),
                        'gender'   => 'Male',
                        'date_of_birth' => '1990-01-01', // Required field
                        'age' => 34,
                        'onbehalf' => 1,
                    ]);
                }
            }
        }

        // 4. Ensure the main 'admin' exists with correct password
        $adminUser = DB::table('free_user')->where('username', 'admin')->first();
        if ($adminUser) {
            DB::table('free_user')->where('username', 'admin')->update([
                'password' => Hash::make('Admin@123'),
                'role' => 'admin'
            ]);
        } else {
            DB::table('free_user')->insert([
                'username' => 'admin',
                'name'     => 'Administrator',
                'emailid'  => 'admin@vmatrimony.com',
                'password' => Hash::make('Admin@123'),
                'role'     => 'admin',
                'status'   => 1,
                'date'     => date('Y-m-d'),
                'userid'   => 'ADM1001',
                'register_id' => 'REGADM001',
                'mid'      => 'MID001',
                'gender'   => 'Male',
                'date_of_birth' => '1990-01-01',
                'age' => 34,
                'onbehalf' => 1,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temple_branches');
        Schema::table('free_user', function (Blueprint $table) {
            $table->dropColumn(['role', 'branch_id', 'username']);
        });
    }
};
