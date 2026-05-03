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
            $table->dropColumn(['razorpay_key', 'razorpay_secret', 'razorpay_webhook_secret']);
            $table->json('config')->nullable()->after('name');
            $table->string('image')->nullable()->after('config');
        });

        // Seed some initial gateways
        DB::table('payment_gateways')->where('name', 'razorpay')->update([
            'config' => json_encode([
                'key' => '',
                'secret' => '',
                'webhook_secret' => ''
            ])
        ]);

        DB::table('payment_gateways')->insert([
            ['name' => 'PhonePe', 'config' => json_encode(['merchant_id' => '', 'salt_key' => '', 'salt_index' => '1']), 'is_active' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Stripe', 'config' => json_encode(['public_key' => '', 'secret_key' => '']), 'is_active' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::table('payment_gateways', function (Blueprint $table) {
            $table->dropColumn(['config', 'image']);
            $table->string('razorpay_key')->nullable();
            $table->string('razorpay_secret')->nullable();
            $table->string('razorpay_webhook_secret')->nullable();
        });
    }
};
