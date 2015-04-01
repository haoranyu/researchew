<?php

class UserController extends BaseController {

    public function getRegister() {
         return View::make('user_register');
    }
    public function getLogin() {
         return View::make('user_login');
    }
    public function getLogout() {
        if(Auth::check()){
            Auth::logout();
        }
        return Redirect::to('/')->with('message','You are now logged out and can only search and read.');
    }

    public function postCreate() {
        $validator = Validator::make(Input::all(), User::$rules);
        if ($validator->passes()) {
            $user = new User;//实例化User对象
            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            return Redirect::to('/user/login')->with('message', 'Welcome! Please Log in.');
        } else {
            return Redirect::to('/user/reg')->with('message', 'Failed registration. Please retry!')->withErrors($validator)->withInput();
        }
    }

    public function postAuth() {
        if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')))) {
            return Redirect::to('/')->with('message', 'Welcome! Search and review paper now!');
        }
        else {
            return Redirect::to('user/login')->with('message', 'Wrong Email or Password')->withInput();
        }
    }
}
