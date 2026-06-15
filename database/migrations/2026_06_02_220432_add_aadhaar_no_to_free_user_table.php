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
            $table->string('aadhaar_no', 20)->nullable()->after('whatsapp_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('free_user', function (Blueprint $table) {
            $table->dropColumn('aadhaar_no');
        });
    }
};
