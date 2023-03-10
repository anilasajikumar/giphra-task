<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;

class UserController extends Controller
{
    //

    public function register(Request $request)
    {
        return view('register.index');
    }

    public function store(Request $request)
    { 
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'address' => 'required',
            'phone' => 'required',
            'dob' => 'required',
            'gender' => 'required',
            'user_type' => 'required'
        ]); 
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        User::create([
                
                'name'  => $request->name,
                'email'  => $request->email,
                'password'  => $request->password,
                'address'  => $request->address,
                'phone'  => $request->phone,
                'dob'  => $request->dob,
                'gender'  => $request->gender,
                'user_type'  => $request->user_type,
                
                
            ]);
            
            
        return redirect("login")->withSuccess('You have signed-in');
    }


            public function login(Request $request)
            {
                return view('login.login');
            }


      public function loginstore(Request $request)
        { 
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
           
        ]); 
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
           
             $credentials = $request->only('email', 'password'); 
             if (Auth::attempt($credentials)) { 
                $user = Auth::user();
                $user_type = $user->user_type; 

                if($user_type == 'manager'){ 

                   return redirect("/manager-dashboard")->withSuccess('Signed in');
                }
                elseif($user_type == 'developer'){

                    return redirect("/developer-dashboard")->withSuccess('Signed in');
                  }
                  else{

                    return redirect("/")->withSuccess('Login details are not valid');

                  }
            
                
             }

             
       
             
    }

            public function logout(Request $request) {
                Auth::logout();
                return redirect('/login');
            }

           public function managerdashboard(Request $request)
            {
                return view('manager.manager-dashboard');
            }


            public function developerdashboard(Request $request)
            {
                return view('developer.developer');
            }



}

