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
        // Fix gotharam table
        DB::statement("ALTER TABLE gotharam MODIFY COLUMN id INT(11) AUTO_INCREMENT");
        DB::statement("ALTER TABLE gotharam MODIFY COLUMN status INT(11) DEFAULT 1");

        // Fix height table
        DB::statement("ALTER TABLE height MODIFY COLUMN id INT(11) AUTO_INCREMENT PRIMARY KEY");
        DB::statement("ALTER TABLE height MODIFY COLUMN status INT(2) DEFAULT 1");

        // Fix marital_status table
        DB::statement("ALTER TABLE marital_status MODIFY COLUMN id INT(11) AUTO_INCREMENT PRIMARY KEY");
        DB::statement("ALTER TABLE marital_status MODIFY COLUMN status INT(11) DEFAULT 1");

        // Fix dosham table
        DB::statement("ALTER TABLE dosham MODIFY COLUMN id INT(11) AUTO_INCREMENT");
        DB::statement("ALTER TABLE dosham MODIFY COLUMN status INT(2) DEFAULT 1");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
