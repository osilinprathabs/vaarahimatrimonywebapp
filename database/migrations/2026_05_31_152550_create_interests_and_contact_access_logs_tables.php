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
        // 1. Create Interests Table
        if (!Schema::hasTable('interests')) {
            Schema::create('interests', function (Blueprint $table) {
                $table->id();
                $table->integer('from_member_id');
                $table->integer('to_member_id');
                $table->integer('plan_id')->nullable();
                $table->string('plan_name', 50)->nullable();
                $table->integer('consumed_interests')->default(1);
                $table->string('status', 20)->default('Pending'); // Pending, Accepted, Rejected, Withdrawn
                $table->timestamps();
            });
        }

        // 2. Create Contact Access Logs Table
        if (!Schema::hasTable('contact_access_logs')) {
            Schema::create('contact_access_logs', function (Blueprint $table) {
                $table->id();
                $table->integer('viewer_id');
                $table->integer('profile_id');
                $table->integer('interest_id');
                $table->timestamp('viewed_time')->useCurrent();
                $table->string('mobile_viewed', 20)->nullable();
                $table->string('email_viewed', 100)->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interests');
        Schema::dropIfExists('contact_access_logs');
    }
};
