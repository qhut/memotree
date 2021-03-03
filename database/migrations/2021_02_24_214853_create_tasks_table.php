<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('task_subject');
            $table->text('task_description')->default('');
            $table->text('task_comments')->default('');
            $table->string('reporter')->default('');
            $table->string('assign')->default('');
            $table->text('priority')->default('Low');
            $table->tinyInteger('task_progress')->default(0);
            $table->string('deadline')->default('');
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
        Schema::dropIfExists('tasks');
    }
}
