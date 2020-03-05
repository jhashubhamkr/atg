<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\ATG;
use App\Rules\UniqueByPin;
use Illuminate\Support\Facades\Log;

trait AddUser {
    public function getUsers() {
        //fetch all users in descending order
        return ATG::orderBy('created_at',"desc")->get();
    }
    public function addUser(Request $request)
    {
    	//validate the request parameters
    	$this->validate($request,[
    		'name'		=>	'required|max:30',
    		'pincode'	=>	'required|digits:6',
            'email'     =>  ['required','max:254','email:rfc,dns',new UniqueByPin($request->pincode)],
    	]);        

    	//create an object of the model ATG
    	$user=new ATG();

    	//add validated values to new object
    	$user->name=$request->name;
    	$user->email=$request->email;
    	$user->pincode=$request->pincode;
    	
    	//save the user object in DB table
    	$user->save();

    	$to_name = $user->name;
		$to_email = $user->email;
		$data = "You are registered successfully";
		
        Log::info('EMAIL SENT');
        return $user;
    }
}