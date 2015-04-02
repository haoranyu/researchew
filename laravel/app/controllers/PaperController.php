<?php

class PaperController extends BaseController {

    public function getPaper($hash)
    {
        $paper = Paper::getPaperByHash($hash);
        $reviews = Review::getReviewsByPaperId($paper['id']);
        return View::make('paper')
                ->with('paper', $paper)
                ->with('reviews', $reviews);
    }

}
