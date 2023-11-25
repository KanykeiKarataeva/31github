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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('child_id');
            $table->index('child_id','payments_children_idx');
            $table->foreign('child_id','payments_children_fk')
                ->on('children')
                ->references('id')
                ->cascadeOnDelete();
            $table->integer('payment_amount');
            $table->date('date_from');
            $table->date('date_to');
            $table->boolean('expired')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
