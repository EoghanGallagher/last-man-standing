<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerPicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('player_picks', function ( Blueprint $table )
        {
            $table->increments( 'id' );
            $table->integer( 'user_id' );
            $table->string( 'match' );
            $table->integer( 'match_day' );
            $table->string( 'team_name' );
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
        Schema::drop( 'player_picks' );
    }
}
