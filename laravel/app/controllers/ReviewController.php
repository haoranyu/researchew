<?php

class ReviewController extends BaseController {

    public function postCreate() {
        $validator = Validator::make(Input::all(), Review::$rules);
        if ($validator->passes() && Auth::check()) {
            Review::addReview(Input::get('content'), Input::get('rating'), Auth::user()->id, Input::get('id'));
            return Redirect::to('/user/login')->with('message', 'Welcome! Please Log in.');
        } else {
            return Redirect::to('/paper/'.hash('sha1', Input::get('id')).'#new-review')->with('message', 'Failed posting review!')->withErrors($validator)->withInput();
        }
    }
}
