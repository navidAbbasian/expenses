<?php

use App\Enums\TransactionTypeEnum;
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
        Schema::create(table: 'transactions',callback:  function (Blueprint $table) {
            $table->id();
            $table->bigInteger(column: 'amount');
            $table->string(column: 'description');
            $table->enum(column: 'type',allowed:  TransactionTypeEnum::values());
            $table->unsignedBigInteger(column: 'from');
            $table->unsignedBigInteger(column: 'to')->nullable();
            $table->timestamps();

            $table->index([
                'from',
                'to'
            ]);

            $table->foreign(columns: 'from')->references(columns: 'id')->on(table: 'banks');
            $table->foreign(columns: 'to')->references(columns: 'id')->on(table: 'banks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'transactions');
    }
};
