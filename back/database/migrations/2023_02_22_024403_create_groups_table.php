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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->integer('limit');
            $table->text('description');
            $table->string('image',200);
            $table->unsignedBigInteger('teacher_id');
            $table->index('teacher_id', 'group_teacher_idx');
            $table->foreign('teacher_id', 'group_teacher_fk')
                ->on('users')
                ->references('id')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
