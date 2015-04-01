<?php

class SearchController extends BaseController {

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |    Route::get('/', 'HomeController@showWelcome');
    |
    */

    public function getSearchResult($query, $page = 1)
    {
        $results = json_decode(file_get_contents('https://web.engr.illinois.edu/~hyu34/scholar/?q='.$query.'&page='.$page), TRUE);
        if($results) {
            foreach($results as &$result) {
                if(sizeof($result['author']) == 1) {
                    $result['author'] = array($result['author']);
                }
                $result['published'] = substr($result['published'], 0, 10).' '.substr($result['published'], 11, 5);
            }
        }
        else {
            return View::make('search')
                    ->with('query', $query)
                    ->with('empty', true);
        }
        $next = '';
        $prev = '';
        if(sizeof($results) < 10) $next = 'disabled';
        if($page == 1) $prev = 'disabled';

        foreach($results as $paper) {
            Paper::storePaper(
                $paper['id'],
                $paper['title'],
                $paper['summary'],
                $paper['author'],
                strtotime(substr($paper['published'], 0, 10).' '.substr($paper['published'], 11, 5))
                );
        }

        return View::make('search')
                ->with('query', $query)
                ->with('results', $results)
                ->with('next', $next)
                ->with('prev', $prev)
                ->with('page', $page)
                ->with('empty', false);
    }

}
