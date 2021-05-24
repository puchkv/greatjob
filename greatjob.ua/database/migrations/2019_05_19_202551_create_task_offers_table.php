<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('performer_id')->unsigned()->index();
            $table->bigInteger('task_id')->unsigned()->index();
            $table->string('message')->default("Привіт! Я хочу запропонувати Вам свої послуги. Зв\'яжитесь зі мною...");
            $table->timestamps();

            $table->foreign('performer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('task_id')
                ->references('id')
                ->on('tasks')
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
        Schema::dropIfExists('task_offers');
    }
}
