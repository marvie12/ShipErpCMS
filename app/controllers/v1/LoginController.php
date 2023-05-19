<?php

class LoginController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Authenticate login
     * @return string   This layout
     */
    public function index()
    {
        if (Auth::check()) {
            return Redirect::to('provider');
        } else {
            $data = array();

            $this->layout = view('layouts.login');

            $this->layout->content = view('login.index', $data);
        }
    }

    /**
     * Logs the user in the CMS
     * @return string   redirect the user to the login page or CMS landing page
     */
    public function login()
    {
        // validate the info, create rules for the inputs
        $rules = array(
            'username' => 'required', // make sure the email is an actual email
            'password' => 'required|min:3', // password can only be alphanumeric and has to be greater than 3 characters
        );

        // run the validation rules on the inputs from the form
        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('/')
                ->withErrors($validator) // send back all errors to the login form
                ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $userdata = array(
                'username' => Input::get('username'),
                'password' => Input::get('password'),
            );

            $userdataFallback = array(
                'username' => Input::get('username'),
                'password' => md5(Input::get('password')),
            );

            $user = User::firstOrNew($userdataFallback);
            
            // attempt to do the login
            if (Auth::attempt($userdata)) {

                $redirect = Input::get('r', 'provider');
                return Redirect::to($redirect);
            } elseif ($user->exists) {

                $user->password = Hash::make($userdata['password']);
                $user->save();

                Auth::login($user);

                $redirect = Input::get('r', 'provider');
                return Redirect::to($redirect);
            } else {

                // validation not successful, send back to form
                return Redirect::to('/')->with('message', 'Username or password is not correct.');
            }
        }
    }

    /**
     * Logs the user out of the CMS
     * @return string   redirect to the login screen
     */
    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('/'); // redirect the user to the login screen
    }
}
