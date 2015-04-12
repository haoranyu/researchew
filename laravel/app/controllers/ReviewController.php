<?php

class ReviewController extends BaseController {

    public function postCreate() {
        $validator = Validator::make(Input::all(), Review::$rules);
        if ($validator->passes() && Auth::check()) {
            if(Review::addReview(Input::get('content'), Input::get('rating'), Auth::user()->id, Input::get('id'))) {
                return Redirect::to('/paper/'.hash('sha1', Input::get('id')).'#reviews')->with('success_msg', 'Yeah! You successfully reviewed the paper!');
            }
            else {
                Review::updateReview(Input::get('content'), Input::get('rating'), Auth::user()->id, Input::get('id'));
                return Redirect::to('/paper/'.hash('sha1', Input::get('id')).'#reviews')->with('success_msg', 'Yeah! You successfully updated your review for the paper!');
            }
        } else {
            return Redirect::to('/paper/'.hash('sha1', Input::get('id')).'#new-review')->with('error_msg', 'Failed posting review!')->withErrors($validator)->withInput();
        }
    }

    public function postDelete() {
        $review = Review::find(Input::get('id'));
        if(Auth::user()->id == $review->user_id || Auth::user()->role == 1) {
            $review->delete();
            return Response::json(true);
        }
        Response::json(false);
    }
}
