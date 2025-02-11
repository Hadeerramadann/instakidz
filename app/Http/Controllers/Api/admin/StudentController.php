<?php  

namespace App\Http\Controllers\Api\admin;
use App\Models\Student;
use Validator;
use App\Http\Controllers\Controller;
use App\Libraries\ApiResponse;
use App\Libraries\ApiValidator;
use App\Libraries\JwtLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function AddStudent(Request $request)
    {
        // dd("ll");
        if ($this->user_id && $this->user_role && $this->user_role == 'admin') {
            $validate = ApiValidator::validate(Student::CreateValidate());

            if ($validate) {
                return ApiResponse::errors($validate->getMessageBag()->first());
            }
            $inputs = $request->all('name','class_id');
            $inputs['user_id']=$this->user_id;
            $student=Student::create($inputs);
            return ApiResponse::data(['student' => $student]);
        }
        return ApiResponse::errors('Token is invalid');
        
    }

    public function list()
    {
       
        if ($this->user_id && $this->user_role && $this->user_role == 'admin') {
            
            $student=Student::all();
            return ApiResponse::data(['students' => $student]);
        }
        return ApiResponse::errors('Token is invalid');
        
    }
   
    
} 


