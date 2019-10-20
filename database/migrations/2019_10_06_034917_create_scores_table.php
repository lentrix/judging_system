<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('contest_judge_id')->unsigned();
            $table->bigInteger('criteria_id')->unsigned();
            $table->bigInteger('contestant_id')->unsigned();
            $table->integer('score')->unsigned();
            $table->timestamps();

            $table->foreign('contest_judge_id')->references('id')->on('contest_judges');
            $table->foreign('criteria_id')->references('id')->on('criterias');
            $table->foreign('contestant_id')->references('id')->on('contestants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
