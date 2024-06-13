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
        Schema::create('table_tasks', function (Blueprint $table) {
            $table->id();
            //$table->biginteger('user_id');
            $table->string('title', 50);
            $table->string('desc', 200);
            $table->boolean('status');
            $table->timestamps();

            //$table->foreign('user_id')->references('id')->on('table_user');
            $table->foreignId('user_id')->constrained('table_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_tasks');
    }
};