<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('to_user_id')->unsigned()->index();
            $table->bigInteger('from_user_id')->unsigned()->index();
            $table->bigInteger('task_id')->unsigned()->index();
            $table->text('message');
            $table->integer('user_grade')->nullable();
            $table->integer('grade_speed')->nullable();
            $table->integer('grade_quality')->nullable();
            $table->integer('grade_cost')->nullable();
            $table->timestamps();

            $table->foreign('to_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('from_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('task_id')
                ->references('id')
                ->on('tasks')
                ->onDelte('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_reviews');
    }
}
