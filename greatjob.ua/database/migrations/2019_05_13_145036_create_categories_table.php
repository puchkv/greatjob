<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->string('slug')->unique();
            $table->string('name')->unique();
            $table->timestamps();

            $table->foreign('parent_id')
            ->references('id')
            ->on('categories')
            ->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
