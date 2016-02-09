<?php
/**
 * Created by PhpStorm.
 * User: Wormwood
 * Date: 28/10/15
 * Time: 13:50
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
//use Illuminate\Routing\Controller;

use DB;


/*trait FixturesTraits
{


    function GetMatchDay()
    {

        //$current_date = Date( 'y-m-d' );

        $current_date = '2015-10-31';

        //echo $current_date . '<BR>';


        $match_day = DB::table( 'fixtures' )->where( 'date',  $current_date )->pluck('match_day');


        return $match_day;

    }



}*/

trait PlayerSelectionTraits
{

    function CheckPlayerPick( $user_id , $match_day )
    {
        //Use user_id and matchday to check if player already made a selection

        $result = DB::table( 'player_picks' )->select( 'team_name' )
            ->where( 'user_id' , $user_id )
            ->where( 'match_day' , $match_day  )->get();


        if( count( $result )  > 0 )
        {

            echo 'RESULT FOUND';

            return true;

        }
        else
        {
            echo 'NO RESULT FOUND';

            return false;

        }

    }

}


class PlayersController extends Controller
{

    use FixturesTrait;
    use PlayerSelectionTraits;


    var $match_day = 0;

    public function TeamList()
    {

        $this->match_day = $this->GetMatchDay();

        // echo  json_encode ( $match_day );


        $result = DB::table( 'fixtures' )->select( 'match', 'home_team_name' , 'away_team_name' )
            ->where( 'match_day' , $this->match_day )->get();

       if( !$result )
       {
           return false;
       }


        $response = array( 'result'=>$result , 'match_day'=>$this->match_day  );

        echo json_encode( $response );

    }

    public function PlayerPicks( Request $request )
    {


        $currentDate = date( "Y-m-d h:i:sa" );


        //Get the current Match Day
        $this->match_day = $this->GetMatchDay();

        //Read user input
        if ( $request->has( 'user_id' ) )
        {
            $id = $request->user_id;
        }

        if( $request->has( 'match_id' ) )
        {

            $match_id = $request->match_id;


        }


        if ($request->has('player_selection'))
        {
            $player_selection = $request->player_selection;
        }


        $has_picked  = $this->CheckPlayerPick(  $id , $this->match_day );

        if( $has_picked )
        {

            //If player has already picked then update DB with change
            DB::table('player_picks')
                ->where( 'user_id', $id )
                ->where( 'match_day', $this->match_day )
                ->update( [ 'match' => $match_id , 'team_name' => $player_selection , 'updated_at' => $currentDate ] );

        }
        else
        {
            //New Pick Add record to DB
            echo 'Player with Id ' . $id . ' chose ' . $player_selection;

            DB::table('player_picks')->insertGetId(

                ['user_id' => $id, 'match' => $match_id,  'match_day' => $this->match_day, 'team_name' => $player_selection ,  'created_at' => $currentDate ]
            );
        }

    }

}