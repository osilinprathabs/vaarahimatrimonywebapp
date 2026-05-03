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
        Schema::table('payment_gateways', function (Blueprint $table) {
            $table->string('secret_key')->nullable()->after('name');
            $table->string('publishable_key')->nullable()->after('secret_key');
            $table->string('webhook_secret')->nullable()->after('publishable_key');
            $table->string('webhook_url')->nullable()->after('webhook_secret');
            $table->string('status')->default('active')->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('payment_gateways', function (Blueprint $table) {
            $table->dropColumn(['secret_key', 'publishable_key', 'webhook_secret', 'webhook_url', 'status']);
        });
    }
};
