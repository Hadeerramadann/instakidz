<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Libraries\JwtLibrary;
use App\Models\User;
use App\Libraries\ApiResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected $user_id, $user_role, $user;

    function __construct()
    {
       

        $token = JwtLibrary::getToken();
       
        if ($token) {
            $data = '';
            try{
                $data = JwtLibrary::decode($token);
               
            }catch(\Exception $exception){
                

                return  ApiResponse::errors('Token is invalid');
            }

            $user_id = $data->user_id;
            $user_role = $data->user_role;

          
                $user = User::find($user_id);
           
            if ($user) {
                $this->user = $user;
                $this->user_id = $user_id;
                $this->user_role = $user_role;
            }
        }

    }
}
