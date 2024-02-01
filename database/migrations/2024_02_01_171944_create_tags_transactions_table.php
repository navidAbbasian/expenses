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
        Schema::create(table: 'tags_transactions',callback:  function (Blueprint $table) {
            $table->foreignId(column: 'tag_id')->references(column:'id')->on(table: 'tags')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId(column: 'transaction_id')->references(column: 'id')->on(table: 'transaction')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'tags_transactions');
    }
};
