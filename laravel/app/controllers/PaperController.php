<?php

class PaperController extends BaseController {

    public function getPaper($hash)
    {
        $paper = Paper::getPaperByHash($hash);
        $reviews = Review::getReviewsByPaperId($paper['id']);
        $logged_user_posted = false;
        foreach($reviews as $review) {
            if(Auth::check() && Auth::user()->id == $review['user_id']) {
                $logged_user_posted = 'am-hide';
            }
        }
        $bow = BOW::getAbstractBOW($paper['id']);
        $new_idea = array_slice(BOW::getDiff($paper['id']), 0, 5);

        $review_distribute = Review::getReviewDistribute($paper['id']);

        return View::make('paper')
                ->with('paper', $paper)
                ->with('reviews', $reviews)
                ->with('new_idea', $new_idea)
                ->with('bow', $bow)
                ->with('review_distribute', $review_distribute)
                ->with('logged_user_posted', $logged_user_posted);
    }

}
