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
        if(!self::hasReview($paper_id, $user_id)) {
            $review = new Review;
            $review->content = $content;
            $review->rating = $rating;
            $review->user_id = $user_id;
            $review->paper_id = $paper_id;
            $review->save();
            return true;
        }
        else {
            return false;
        }
    }

    public static function updateReview($content, $rating, $user_id, $paper_id) {
        if(self::hasReview($paper_id, $user_id)) {
            $review = static::where('paper_id', $paper_id)->where('user_id', $user_id);
            $review->update(array('content' => $content, 'rating' => $rating));
            return true;
        }
        else {
            return false;
        }
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

        $reviews = static::where('paper_id', $paper_id)->orderBy('id','desc')->get()->toArray();
        foreach($reviews as &$review) {
            $review['flag'] = $flag[$review['rating']];
            $review['user'] = User::find($review['user_id']);
            $review['avatar'] = md5( strtolower( trim( $review['user']->email ) ) );

        }

        return $reviews;
    }

    public static function getPaperRatings($paper_id) {
        return static::where('paper_id', $paper_id)->groupBy('rating')->orderBy('rating')->get()->toArray();
    }

    private static function hasReview($paper_id, $user_id) {
        return static::where('paper_id', $paper_id)->where('user_id', $user_id)->exists();
    }
}
