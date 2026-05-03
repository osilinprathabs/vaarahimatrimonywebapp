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
        try {
            \Illuminate\Support\Facades\DB::statement("ALTER TABLE profile_images MODIFY COLUMN id INT(11) AUTO_INCREMENT");
        } catch (\Exception $e) {
            // Ignore if it fails due to existing constraints
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not easily reversible
    }
};
