<?php

class Review extends \Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reviews';


    public static function addReview($content, $rating, $user_id, $paper_id) {
        $review = new Review;
        $review->content = $content;
        $review->rating = $rating;
        $review->user_id = $user_id;
        $review->paper_id = $paper_id;
        $paper->save();
    }

    public static function getReviewsByPaperId($paper_id) {
        return static::where('paper_id', $paper_id)->get()->toArray();
    }

    public static function getPaperRatings($paper_id) {
        return static::where('paper_id', $paper_id)->groupBy('rating')->get()->toArray();
    }
}
