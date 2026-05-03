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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default settings
        DB::table('settings')->insert([
            ['key' => 'site_name', 'value' => 'Sri Vaarahi Matrimony'],
            ['key' => 'menu_name', 'value' => 'Vaarahi Admin'],
            ['key' => 'footer_text', 'value' => '© 2026 Sri Vaarahi Matrimony. All rights reserved.'],
            ['key' => 'logo', 'value' => null],
            ['key' => 'favicon', 'value' => null],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
