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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id');
            $table->index('parent_id','children_user_idx');
            $table->foreign('parent_id','children_user_fk')
                ->on('users')
                ->references('id')
                ->cascadeOnDelete();
            $table->string('name',50);
            $table->string('surname',50);
            $table->date('birth_date');
            $table->string('gender')->nullable(); //MALE, FEMALE
            $table->string('birth_certificate',200);
            $table->string('med_certificate',200);
            $table->string('med_disability', 200)->nullable();
            $table->string('photo',200);
            $table->boolean('payment')->default(false);
            $table->integer('deleted')->default(0);
            $table->unsignedBigInteger('group_id');
            $table->index('group_id','children_groups_idx');
            $table->foreign('group_id','children_groups_fk')
                ->on('groups')
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
        Schema::dropIfExists('children');
    }
};
