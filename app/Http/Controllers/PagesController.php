<?php



namespace App\Http\Controllers;

class PagesController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function home()
    {

        return view( 'pages.home' );

    }

}