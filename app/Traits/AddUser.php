<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\ATG;
use App\Rules\UniqueByPin;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreUser;

trait AddUser {
    public function getUsers() {
        //fetch all users in descending order
        return ATG::orderBy('created_at',"desc")->get();
    }
    public function addUser(StoreUser $request)
    {
    	//validate the request parameters    

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