<?php

class PaperController extends BaseController {

    public function getPaper($hash)
    {
        $paper = Paper::getPaperByHash($hash);
        $reviews = Review::getReviewsByPaperId($paper['id']);
        $logged_user_posted = false;
        foreach($reviews as $review) {
            if(Auth::user()->id == $review['user_id']) {
                $logged_user_posted = 'am-hide';
            }
        }
        $bow = BOW::getBOW($paper['id']);

        $review_distribute = Review::getReviewDistribute($paper['id']);

        return View::make('paper')
                ->with('paper', $paper)
                ->with('reviews', $reviews)
                ->with('bow', $bow)
                ->with('review_distribute', $review_distribute)
                ->with('logged_user_posted', $logged_user_posted);
    }

}
