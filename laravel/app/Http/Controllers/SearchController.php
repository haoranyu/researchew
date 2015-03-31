<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class SearchController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Welcome Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index($query)
    {
        $results = json_decode(file_get_contents('https://web.engr.illinois.edu/~hyu34/scholar/?q='.$query), TRUE);
        return view('search',['results' => $results, 'query' => $query]);
    }

}
