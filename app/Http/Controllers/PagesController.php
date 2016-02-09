<?php



namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Schema;


class PagesController extends Controller
{

    use FixturesTrait;

    /**
     * @return \Illuminate\View\View
     */
    public function home()
    {

        return view( 'pages.home' );

    }


    public function TeamSelectionScreen()
    {

        return view( 'pages.TeamSelection' );

    }


   public function Fixtures()
   {


       $fixtures =  $this->GetFixtures();

       if( $fixtures )
       {

           $count = 0;
           $fixture_items = array();
           //Check if my fixtures table is empty
           $rows = DB::table('fixtures')->select( 'id' )->get();


            if( count( $rows ) > 0 )
            {

                foreach( $fixtures as &$fixture )
                {
                    $count++;

                    DB::table('fixtures')
                        ->where( 'id', $count )
                        ->update( [ 'date' => $fixture[ 'date' ] , 'status'=> $fixture[ 'status' ] ] );

                }

                echo 'Fixtures Updated ' . '<BR/>';

            }
            else
            {
                DB::table( 'fixtures' )->insert( $fixtures );
            }




           //DB::table( 'fixtures' )->insert( $fixtures );

       }
       else
       {

           echo 'Problem with the Fixtures Rss Feed';

       }


   }



}