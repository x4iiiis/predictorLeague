<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('homeTeam');
            $table->string('homeEmblem');
            $table->string('awayTeam');
            $table->string('awayEmblem');
            $table->dateTime('kickoff');
            $table->integer('homeGoals')->nullable();
            $table->integer('awayGoals')->nullable();
            $table->boolean('etp_available')->default(0);
            $table->integer('homeGoalsAET')->nullable();
            $table->integer('awayGoalsAET')->nullable();
            $table->integer('homeGoalsPens')->nullable();
            $table->integer('awayGoalsPens')->nullable();
            $table->string('winner')->nullable();

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
        Schema::dropIfExists('matches');
    }
}
