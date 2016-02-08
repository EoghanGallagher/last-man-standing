<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'fixtures' , function ( Blueprint $table )
        {
            $table->increments( 'id' );
            $table->integer( 'match_day' );
            $table->date( 'date' );
            $table->string( 'match' );
            $table->string( 'home_team_name' );
            $table->string( 'away_team_name' );
            $table->integer( 'goals_home_team' );
            $table->integer( 'goals_away_team' );
            $table->string( 'status' );
            $table->integer( 'admin_match_day' );
            $table->timestamp( 'created_at' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop( 'fixtures' );
    }
}
