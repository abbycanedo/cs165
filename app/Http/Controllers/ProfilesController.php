<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Validator;
use App\User;
use App\Profiles;
use App\Http\Requests;
use Redirect;
use Session;
use AuthenticatesUsers;

class ProfilesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
		$this->user =  \Auth::user();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
		if (Auth::user() != $user){
			return view('errors.restricted');
		} else{
	        $profiles = Profiles::where('users_id', Auth::user()->id)->get();
        	return view('profile.view')->with('profiles', $profiles);
        }
    }

    public function edit(User $user)
    {
		if (Auth::user() != $user){
			return "Restricted access!";
		} else{
	        $profiles = Profiles::where('users_id', Auth::user()->id)->get();
        	return view('profile.edit')->with('profiles', $profiles);
        }
    }

    protected function update($id, Request $request)
    {
        $user = User::where('id', $id)->get();
        $credentials = ['email' => Auth::user()->email, 'password' => $request['password']];

        $data = [];
        $data['firstname'] = $request['firstname'];
        $data['lastname'] = $request['lastname'];
        $data['email'] = $request['email'];

        if(Auth::user()->email == $request['email']){
            $validator = Validator::make($data, [
                'firstname' => 'required|regex:/^[\pL\s\-]+$/u',
                'lastname' => 'required|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email'
            ]);
        }else{
            $validator = Validator::make($data, [
                'firstname' => 'required|regex:/^[\pL\s\-]+$/u',
                'lastname' => 'required|regex:/^[\pL\s\-]+$/u',
                'email' => 'required|email|unique:users'
            ]);
        }

        if(Auth::validate($credentials)){
            if($request['isadmin'] == 0){
                $data['bday'] = $request['bday'];
                $data['contact'] = $request['contact'];
                $data['address'] = $request['address'];

                $validator2 = Validator::make($data, [
                    'bday' => 'required|date',
                    'contact' => 'required|numeric',
                    'address' => 'required'
                ]);

                if($validator->passes() && $validator2->passes()){
                    User::where('id', Auth::user()->id)->update(array(
                                'firstname' => $request['firstname'],
                                'lastname' => $request['lastname'],
                                'email' => $request['email'],
                    ));

                    Profiles::where('users_id', Auth::user()->id)->update(array(
                            'bday' => $request['bday'],
                            'contact' => $request['contact'],
                            'address' => $request['address'],
                    ));
                    Session::flash('success', "Success! Profile updated");
                } else{
                    Session::flash('error', "Error, try again! Make sure all input is valid.");
                }
            } else{
                if($validator->passes()){
                    User::where('id', Auth::user()->id)->update(array(
                                'firstname' => $request['firstname'],
                                'lastname' => $request['lastname'],
                                'email' => $request['email'],
                    ));
                    Session::flash('success', "Success! Profile updated");
                } else {
                    Session::flash('error', "Error, try again! Make sure all input is valid.");
                }
            }
        } else{
            Session::flash('error', "Error, try again! Make sure your password is correct.");
        }
        return Redirect::back();
    }

    protected function password($id, Request $request)
    {

        $data = [];
        $data['password'] = $request['password'];
        $data['new_password'] = $request['new_password'];
        $data['password_confirmation'] = $request['password_confirmation'];

        $validator = Validator::make($data, [
            'password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'password_confirmation' => 'required|min:6'
        ]);

        $user = User::where('id', $id)->get();
        $credentials = ['email' => Auth::user()->email, 'password' => $request['password']];
        if($validator->passes() && ($request['new_password'] == $request['password_confirmation'])){
            if(Auth::validate($credentials)){
                User::where('id', Auth::user()->id)->update(array(
                            'password' => bcrypt($request['new_password']),
                ));
                Session::flash('success', 'Success! Password updated.');
            } else{
                Session::flash('error', "Error, try again! Make sure your old password is correct.");
            }
        } else{
            Session::flash('error', "Error, try again! Password update failed.");
        }
        return Redirect::back();
    }

}