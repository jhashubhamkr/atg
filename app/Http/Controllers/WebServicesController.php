<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\AddUser;

class WebServicesController extends Controller
{
	use AddUser;
	protected function buildFailedValidationResponse(Request $request, array $errors)
    {
       return new JsonResponse($errors, 422);
    }
    public function index()
    {
        $users=$this->getUsers();

        $response['status']=1;
        $response['message']="Success";
        $response['data']=$users;

        return $response;
    }
    public function store(Request $request)
    {
    	$user=$this->addUser($request);
    	
    	$response['status']=1;
    	$response['message']="Success";
    	$response['data']=$user;

    	return $response;
    }
}
