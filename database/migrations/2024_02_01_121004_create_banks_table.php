<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(table: 'banks', callback: function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(column: 'user_id');
            $table->string(column: 'name');
            $table->unsignedBigInteger(column: 'account_owner');
            $table->unsignedBigInteger(column: 'account_number');
            $table->integer(column: 'balance')->default(0);
            $table->timestamps();

            $table->foreign(columns: 'account_owner')->references(columns: 'id')->on(table: 'users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign(columns: 'user_id')->references(columns: 'id')->on(table: 'users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'banks');
    }
};
