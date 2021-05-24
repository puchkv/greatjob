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
            $table->bigInteger('category_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('performer_id')->unsigned()->index()->nullable();
            $table->enum('status', ['OPEN', 'CLOS', 'DONE', 'PROG', 'DEL']);
            $table->string('title');
            $table->string('description');
            $table->string('contacts');
            $table->integer('cost');
            $table->tinyInteger('cost_contract')->default(0);
            $table->date('needBeginDate');
            $table->date('needEndDate');
            $table->dateTime('accepted_at')->nullable();
            $table->dateTime('done_at')->nullable();
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('performer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
