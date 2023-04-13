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
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('topic_id');
            $table->integer('homework_mark')->nullable();
            $table->timestamp('task_end_at')->nullable();
            $table->integer('task_number')->default(0);
            $table->integer('mistakes')->default(0);
            $table->timestamp('test_end_at')->nullable();
            $table->timestamp('test_mistakes')->nullable();
            $table->timestamps();

            $table->index('user_id', 'progress_user_idx');
            $table->foreign('user_id', 'progress_user_fk')->on('users')->references('id');

            $table->foreign('topic_id', 'progress_topic_fk')->on('topics')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progress');
    }
};
