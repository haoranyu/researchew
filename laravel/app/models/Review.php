<?php

class Review extends \Eloquent {


    public static $rules = array(
        'rating'=>'required|numeric|digits_between:1,5',
        'content'=>'required'
        );

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
        $review->save();
    }

    public static function getReviewsByPaperId($paper_id) {
        $flag = array(
            '',
            'danger',
            'danger',
            'warning',
            'success',
            'success'
        );
        $reivews = static::where('paper_id', $paper_id)->orderBy('id','desc')->get()->toArray();
        foreach($reivews as &$reivew) {
            $reivew['flag'] = $flag[$reivew['rating']];
        }
        return $reivews;
    }

    public static function getPaperRatings($paper_id) {
        return static::where('paper_id', $paper_id)->groupBy('rating')->orderBy('rating')->get()->toArray();
    }
}
