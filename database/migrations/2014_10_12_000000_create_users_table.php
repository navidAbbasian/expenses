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
        Schema::create(table: 'users',callback:  function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name');
            $table->string(column: 'number')->nullable();
            $table->string(column: 'email');
            $table->string(column: 'password');
            $table->string(column: 'remember_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'users');
    }
};
