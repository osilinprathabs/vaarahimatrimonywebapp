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
        Schema::create('member_horoscope', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id')->nullable();
            
            for ($i = 1; $i <= 12; $i++) {
                $table->string("rasi_$i")->nullable();
            }
            
            for ($i = 1; $i <= 12; $i++) {
                $table->string("amsam_$i")->nullable();
            }

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_horoscope');
    }
};
