<?php
/**
 * Created by PhpStorm.
 * User: Wormwood
 * Date: 05/11/15
 * Time: 14:13
 */


namespace App\Http\Controllers;


use DB;

trait FixturesTrait
{


    public function GetMatchDay()
    {



        //$current_date = Date( 'y-m-d' );

        $current_date = '2015-11-07';

        //echo $current_date . '<BR>';


        $match_day = DB::table( 'fixtures' )->where( 'date',  $current_date )->pluck('match_day');


        return $match_day;

    }

    public function GetFixtures()
    {

        $uri= 'http://api.football-data.org//alpha/soccerseasons/398/fixtures/';
        //$uri = 'http://api.football-data.org/alpha/fixtures?season=2015&timeFrame=n30';
        $reqPrefs['http']['method'] = 'GET';
        $reqPrefs['http']['header'] = 'X-Auth-Token: 3e63e83dd76e40f19258608e5e3d77ec';


        $stream_context = stream_context_create( $reqPrefs );

        $response = file_get_contents( $uri, false, $stream_context );

        $fixtures = json_decode( html_entity_decode($response) , true );

        $tally = 0;

        $count = 0;

        $fixture_items =  array();
        $fixture_item = array();

        $service_url = 'http://localhost:8080/last-man-standing/v1/fixtures';



        $stream_context = stream_context_create( $reqPrefs );

        $response = file_get_contents( $uri, false, $stream_context );

        $fixtures = json_decode( html_entity_decode($response) , true );


        echo 'Updating Fixtures List... <br/>';


        $fixture_headings = 'match_day' . ',' . 'date' . ',' . 'status' . ',' . 'home_team_name' . ',' . 'away_team_name' . ',' . 'goals_home_team' . ',' . 'goals_away_team';


        foreach ($fixtures as $fixture )
        {


            if ( is_array( $fixture ) )
            {


                $count = 0;

                foreach ( $fixture as $item )
                {

                    // print_r($item);


                    if( $count  > 1 )
                    {

                        /*  echo '<br/> Date : ' . $item['date'] . '<BR/>';
                          echo 'HOME TEAM ' . $item['homeTeamName'] . ' ' . $item['result']['goalsHomeTeam'] . '<BR/>';
                          echo 'AWAY TEAM ' . $item['awayTeamName'] . ' ' . $item['result']['goalsAwayTeam'] . '<BR/>';


                          echo 'MatchDay ' . $item['matchday'] . '<br/>';
                          echo 'Date ' . $item['date'] . '<br/>';
                          echo 'Status ' . $item['status'] . '<br/>';*/


                        // $fixture_item = $item['matchday'] . ',' . $item['date'] . ',' . $item['homeTeamName'] . ',' . $item['awayTeamName'] . ',' . $item['result']['goalsHomeTeam'] . ',' . $item['result']['goalsAwayTeam'] . ',' . $item['status'];

                        $fixture_item[ 'match_day' ] = $item[ 'matchday' ];
                        $fixture_item[ 'date' ] = $item[ 'date' ];
                        $fixture_item[ 'match' ] = $item[ 'homeTeamName' ] . '_' . $item[ 'awayTeamName' ];
                        $fixture_item[ 'home_team_name' ] = $item[ 'homeTeamName' ];
                        $fixture_item[ 'away_team_name' ] = $item[ 'awayTeamName' ];
                        $fixture_item[ 'goals_home_team' ] = $item['result'][ 'goalsHomeTeam' ];
                        $fixture_item[ 'goals_away_team' ] = $item['result'][ 'goalsAwayTeam' ];
                        $fixture_item[ 'status' ] = $item[ 'status' ];


                        array_push( $fixture_items, $fixture_item );


                        //unset( $fixture_item );

                        //array_push( $fixture_items, $fixture_item );

                    }

                    $count ++;


                }


                if( $count == 3 )
                {

                    break;

                }

            }


        }


        if( count( $fixture_items ) > 0 )
        {

            return $fixture_items;

        }
        else
        {

            return false;

        }







    }



}