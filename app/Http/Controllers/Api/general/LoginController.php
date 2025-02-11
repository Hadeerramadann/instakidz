<?php  

namespace App\Http\Controllers\Api\general;
use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use App\Libraries\ApiResponse;
use App\Libraries\ApiValidator;
use App\Libraries\JwtLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
 

        $validate = ApiValidator::validate(User::loginValidate(), ['email.required' => 'Email is Required.']);

        if ($validate) {
            return ApiResponse::errors($validate->getMessageBag()->first());
        }

        $username = $request->input('email');
        $password = $request->input('password');
        
        $user = User::where('email', $username)->first();
        $id=$user->id;
        $role= $user->role;
        if ($user) {
            if (Hash::check($password, $user->password)) {
                
                    $token = JwtLibrary::encode( $id,$role);
                    $user['token'] = $token;
                    
                    return ApiResponse::data(['user' => $user]);
                
            } else {
                return  ApiResponse::errors( " Invalied password  ");
            }
        } else {
            return ApiResponse::errors(" Invalied email ");
        }
    }


   
    
} 


