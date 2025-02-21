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
        Schema::create(table: 'list_items',callback:  function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'list_title_id')->constrained(table: 'list_titles')->onDelete(action: 'cascade');
            $table->string(column: 'name');
            $table->boolean('is_complete')->nullable()  ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'list_items');
    }
};
