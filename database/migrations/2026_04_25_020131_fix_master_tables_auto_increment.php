<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix religion table
        DB::statement("ALTER TABLE religion MODIFY COLUMN id INT(11) AUTO_INCREMENT PRIMARY KEY");
        DB::statement("ALTER TABLE religion MODIFY COLUMN status VARCHAR(255) DEFAULT '1'");

        // Fix caste table
        DB::statement("ALTER TABLE caste MODIFY COLUMN id INT(11) AUTO_INCREMENT");
        DB::statement("ALTER TABLE caste MODIFY COLUMN status VARCHAR(255) DEFAULT '1'");

        // Fix subcaste table
        DB::statement("ALTER TABLE subcaste MODIFY COLUMN id INT(11) AUTO_INCREMENT PRIMARY KEY");
        DB::statement("ALTER TABLE subcaste MODIFY COLUMN status VARCHAR(255) DEFAULT '1'");

        // Fix raasi table
        DB::statement("ALTER TABLE raasi MODIFY COLUMN id INT(11) AUTO_INCREMENT PRIMARY KEY");
        DB::statement("ALTER TABLE raasi MODIFY COLUMN status INT(2) DEFAULT 1");

        // Fix star table
        DB::statement("ALTER TABLE star MODIFY COLUMN id INT(11) AUTO_INCREMENT PRIMARY KEY");
        DB::statement("ALTER TABLE star MODIFY COLUMN status INT(2) DEFAULT 1");

        // Fix education table
        DB::statement("ALTER TABLE education MODIFY COLUMN id INT(11) AUTO_INCREMENT");
        DB::statement("ALTER TABLE education MODIFY COLUMN status INT(2) DEFAULT 1");

        // Fix occupation table
        DB::statement("ALTER TABLE occupation MODIFY COLUMN id INT(11) AUTO_INCREMENT PRIMARY KEY");
        DB::statement("ALTER TABLE occupation MODIFY COLUMN status INT(2) DEFAULT 1");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not easily reversible with simple statements, but we could remove AI if needed.
    }
};
