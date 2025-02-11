<?php  

namespace App\Http\Controllers\Api\teacher;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Classes;
use Validator;
use App\Http\Controllers\Controller;
use App\Libraries\ApiResponse;
use App\Libraries\ApiValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class AttendanceController extends Controller
{
    public function markStudentAttendance(Request $request)
    {
        // dd("ll");
        if ($this->user_id && $this->user_role && $this->user_role == 'teacher') {
            $validate =  ApiValidator::validate([
                'student_id' => 'required|exists:students,id',
                'class_id' => 'required|exists:classes,id',
                'status' => 'required|in:present,absent,late', 
            ]);
    
            if ($validate) {
                return ApiResponse::errors($validate->getMessageBag()->first());
            }
            $class = Classes::where('id', $request->class_id)
                       ->where('teacher_id', $this->user_id)
                       ->first();

            if (!$class) {
                return response()->json(['message' => 'Unauthorized. You can only mark attendance for your class.'], 403);
              
            }

            
            $student = Student::where('id', $request->student_id)
                            ->where('class_id', $request->class_id)
                            ->first();

            if (!$student) {
                return response()->json(['message' => 'Invalid student. The student does not belong to this class.'], 403);
            }

            $attendance = Attendance::firstOrCreate(
                [
                    'student_id' => $request->student_id,
                    'class_id' => $request->class_id,
                    'date' => Carbon::today(),
                ],
                [
                    'status' => $request->status,
                ]
            );
            if (!$attendance->wasRecentlyCreated) {
                return response()->json(['message' => 'Attendance already recorded for this student today'], 409);
            }
            return ApiResponse::data(['attendance' => $attendance]);
        }
        return ApiResponse::errors('Token is invalid');
    }
    

}