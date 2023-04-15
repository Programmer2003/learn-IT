<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('description');
            $table->text('full_description')->nullable();
            $table->text('url');
            $table->text('homework')->nullable();
            $table->text('homework_img')->nullable();
            $table->text('lecture_text')->default('Пока нет текста');
            $table->text('lecture_link')->nullable();
            $table->text('lecture_meet_link')->nullable();
            $table->text('tasks')->nullable();
            $table->text('answers')->nullable();
            $table->text('tasks_more')->nullable();
            $table->text('answers_more')->nullable();
            $table->text('test_questions')->nullable();
            $table->text('test_answers')->nullable();
            $table->text('test_help')->nullable();
            $table->text('test_help_question')->nullable();
            $table->text('test_help_answer')->nullable();
            $table->text('test_help_t_questions')->nullable();
            $table->text('test_help_t_answers')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
};
