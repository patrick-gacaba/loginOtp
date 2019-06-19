<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\register;
use Hash;

class registerController extends Controller
{
    public function register(){
    	 return view('register');

    	}

    	public function store(Request $request){
       $credentials= $this->validate($request,[
            'name'=>'required',
           'email'=>'required|email',
            'password'=>'required'

        ]);
        $user= new register;
        $user->name= $credentials['name'];
        $user->email=$credentials['email'];
        $user->password=Hash::make($credentials['password']);

        $user->save();

        // return response()->json([
        //     'status'=>'ok',


        // ]);
        return redirect()->intended('/login');


    }
}
