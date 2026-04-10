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
        // 1. Missing Tables
        if (!Schema::hasTable('plan_assign')) {
            Schema::create('plan_assign', function (Blueprint $table) {
                $table->id();
                $table->integer('member_id')->unique();
                $table->integer('plan_id');
                $table->date('plan_start_date');
                $table->date('plan_end_date');
                $table->string('plan_status', 20)->default('Active');
                $table->timestamps();
            });
        }

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

        // 2. Missing Columns & Modifications
        if (Schema::hasTable('subcaste')) {
            Schema::table('subcaste', function (Blueprint $table) {
                if (!Schema::hasColumn('subcaste', 'caste_id')) {
                    $table->integer('caste_id')->nullable()->after('id');
                }
            });
        }

        if (Schema::hasTable('profile_images')) {
            Schema::table('profile_images', function (Blueprint $table) {
                if (!Schema::hasColumn('profile_images', 'created_at')) {
                    $table->timestamps();
                }
            });
        }

        if (Schema::hasTable('free_user')) {
            Schema::table('free_user', function (Blueprint $table) {
                if (!Schema::hasColumn('free_user', 'register_id')) {
                    $table->string('register_id', 50)->nullable()->after('id');
                } else {
                    $table->string('register_id', 50)->nullable()->change();
                }
            });
        }

        if (Schema::hasTable('admin')) {
            Schema::table('admin', function (Blueprint $table) {
                // Fix invalid default values (0000-00-00 00:00:00) before other changes
                if (Schema::hasColumn('admin', 'registered_on')) {
                    $table->dateTime('registered_on')->nullable()->default(null)->change();
                }
                if (Schema::hasColumn('admin', 'last_activity')) {
                    $table->dateTime('last_activity')->nullable()->default(null)->change();
                }
                
                if (Schema::hasColumn('admin', 'user_id')) {
                    $table->string('user_id', 191)->change();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We generally don't want to drop tables that might have data from legacy CI
        // But for completeness:
        // Schema::dropIfExists('plan_assign');
        // Schema::dropIfExists('payments');
    }
};
