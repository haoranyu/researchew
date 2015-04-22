<?php

class SearchController extends BaseController {

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
        if(sizeof($results) < 10) $next = 'am-disabled';
        if($page == 1) $prev = 'am-disabled';

        foreach($results as $paper) {
            Paper::storePaper(
                $paper['id'],
                $paper['title'],
                $paper['summary'],
                $paper['author'],
                strtotime(substr($paper['published'], 0, 10).' '.substr($paper['published'], 11, 5))
                );
        }

        $reviews = Review::join('users', 'reviews.user_id', '=', 'users.id')->where('reviews.content', 'LIKE', '%'.$query.'%')->orderBy('reviews.id', 'desc')->take(5)->get()->toArray();

        return View::make('search')
                ->with('query', $query)
                ->with('reviews', $reviews)
                ->with('results', $results)
                ->with('next', $next)
                ->with('prev', $prev)
                ->with('page', $page)
                ->with('empty', false);
    }

}
