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
            'warning',
            'primary',
            'secondary',
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

    public static function getReviewDistribute($paper_id) {
        $distribute[5] = static::where('paper_id', $paper_id)->where('rating', 5)->count();
        $distribute[4] = static::where('paper_id', $paper_id)->where('rating', 4)->count();
        $distribute[3] = static::where('paper_id', $paper_id)->where('rating', 3)->count();
        $distribute[2] = static::where('paper_id', $paper_id)->where('rating', 2)->count();
        $distribute[1] = static::where('paper_id', $paper_id)->where('rating', 1)->count();
        $sum = array_sum($distribute);
        foreach($distribute as &$d) {
            if($sum != 0) {
                $d = $d / $sum * 100;
            }
        }
        return $distribute;
    }

    private static function hasReview($paper_id, $user_id) {
        return static::where('paper_id', $paper_id)->where('user_id', $user_id)->exists();
    }
}
