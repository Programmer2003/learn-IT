<?php

use Carbon\Carbon;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('points')->default(0);
            $table->string('email')->unique();
            $table->integer('topic')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('admin')->nullable();
            $table->boolean('mode')->default(0);
            $table->boolean('hard')->default(0);
            $table->integer('code')->default(100);
            $table->date('end_at')->default(Carbon::now()->addMonths(3));
            $table->date('mode_changed_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
