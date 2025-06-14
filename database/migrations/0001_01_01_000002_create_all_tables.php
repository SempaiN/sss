<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');               // bigint unsigned, auto increment y PK
            $table->string('name', 100);
            $table->string('surname', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 255)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');               // bigint unsigned, auto increment y PK
            $table->string('title', 255);
            $table->text('description');
            $table->date('expiration_date');
            $table->boolean('completed')->default(false);
            $table->unsignedBigInteger('user_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::create('shared_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');               // bigint unsigned, auto increment y PK
            $table->unsignedBigInteger('task_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->unique(['task_id', 'user_id']);

            $table->foreign('task_id')
                ->references('id')->on('tasks')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shared_tasks');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('users');
    }
};
