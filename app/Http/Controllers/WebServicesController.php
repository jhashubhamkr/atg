<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\AddUser;
use App\Http\Requests\StoreUser;
use Illuminate\Http\Response;

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
    public function store(StoreUser $request)
    {
    	$user=$this->addUser($request);
    	
    	$response = new Response();
        $response->status = 1;
    	$response->message="$user->name was addedd successfully";
    	$response->data=$user;

    	return json_encode($response);
    }
}
