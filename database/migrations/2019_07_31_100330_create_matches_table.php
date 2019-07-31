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
            $table->integer('homegoals')->nullable();
            $table->integer('awayGoals')->nullable();
            $table->json('predictions')->nullable();
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
