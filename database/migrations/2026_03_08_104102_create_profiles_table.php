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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('user_name', 12)->unique();
            $table->string('name', 50);
            $table->tinyInteger('gender')->default(0);
            $table->date('dob')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('caste')->nullable();
            $table->string('sub_caste')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->string('occupation')->nullable();
            $table->string('education')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->text('about_me')->nullable();
            $table->string('mobile')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->tinyInteger('approved')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
