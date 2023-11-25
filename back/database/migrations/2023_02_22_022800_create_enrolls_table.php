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
        Schema::create('enrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id');
            $table->index('parent_id','enroll_user_idx');
            $table->foreign('parent_id','enroll_user_fk')
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
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrolls');
    }
};
