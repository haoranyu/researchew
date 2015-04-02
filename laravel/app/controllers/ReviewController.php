<?php

class ReviewController extends BaseController {

    public function postCreate() {
        $validator = Validator::make(Input::all(), Review::$rules);
        if ($validator->passes() && Auth::check()) {
            if(Review::addReview(Input::get('content'), Input::get('rating'), Auth::user()->id, Input::get('id'))) {
                return Redirect::to('/paper/'.hash('sha1', Input::get('id')).'#reviews')->with('success_msg', 'Yeah! You successful reviewed the paper!');
            }
            else {
                return Redirect::to('/paper/'.hash('sha1', Input::get('id')).'#new-review')->with('error_msg', 'You have already posted a review. Please do not do twice.')->withInput();
            }
        } else {
            return Redirect::to('/paper/'.hash('sha1', Input::get('id')).'#new-review')->with('error_msg', 'Failed posting review!')->withErrors($validator)->withInput();
        }
    }
}
