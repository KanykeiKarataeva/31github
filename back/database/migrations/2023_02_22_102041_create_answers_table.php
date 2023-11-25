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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->index('question_id','answers_questions_idx');
            $table->foreign('question_id','answers_questions_fk')
                ->on('questions')
                ->references('id')
                ->cascadeOnDelete();
            $table->text('answers')->nullable();
            $table->unsignedBigInteger('resume_id');
            $table->index('resume_id','answers_resumes_idx');
            $table->foreign('resume_id','answers_resumes_fk')
                ->on('resumes')
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
        Schema::dropIfExists('answers');
    }
};
