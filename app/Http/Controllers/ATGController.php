<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\AddUser;
use App\Http\Requests\StoreUser;

class ATGController extends Controller
{
    use AddUser;
    public function index()
    {
        $users=$this->getUsers();
        return view('atg.index',compact('users'));
    }
    public function create()
    {
    	//show the view with user form
    	return view('atg.create');
    }
    public function store(StoreUser $request)
    {
    	$user=$this->addUser($request);
        
    	//redirect user to new page with success message
    	return redirect()->route('atg.index')->withSuccess("$user->name addedd successfully");
    }
}
