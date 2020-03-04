<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ATG;

class ATGController extends Controller
{
    public function index()
    {
        //fetch all users in descending order
        $users=ATG::orderBy('created_at',"desc")->get();
        return view('atg.index',compact('users'));
    }
    public function create()
    {
    	//show the view with user form
    	return view('atg.create');
    }
    public function store(Request $request)
    {
    	//validate the request parameters
    	$this->validate($request,[
    		'name'		=>	'required|max:30',
    		'email'		=>	'required|max:254|email:rfc,dns|unique:atgs',
    		'pincode'	=>	'required|digits:6'
    	]);
    	
    	//create an object of the model ATG
    	$user=new ATG();

    	//add validated values to new object
    	$user->name=$request->name;
    	$user->email=$request->email;
    	$user->pincode=$request->pincode;
    	
    	//save the user object in DB table
    	$user->save();

    	//redirect user to new page with success message
    	return redirect()->route('atg.index')->withSuccess("$user->name addedd successfully");
    }
}
