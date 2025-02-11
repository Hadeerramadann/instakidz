<?php
namespace App\Http\Controllers\Api\general;

use App\Http\Controllers\Controller;
use App\Libraries\ApiResponse;
use App\Models\Attendance;
use App\Models\Classes;
use DB;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    private function classBelongsToTeacher($teacher_id, $class_id)
    {
        return Classes::where('id', $class_id)
            ->where('teacher_id', $teacher_id)
            ->exists();
    }
    public function getClassAttendance($class_id)
    {

        if ($this->user_role === 'teacher' && ! $this->classBelongsToTeacher($this->user_id, $class_id)) {
            return ApiResponse::errors('Unauthorized', 403);
        }

        return ApiResponse::data($this->generateClassAttendance($class_id));
    }

    private function generateClassAttendance($class_id)
    {
        $Attendance= Attendance::where('class_id', $class_id)
            ->selectRaw("
            status,
            COUNT(*) as count,
            ROUND((COUNT(*) * 100.0 / (SELECT COUNT(*) FROM attendance WHERE class_id = ?)), 2) as percentage
        ", [$class_id])
            ->groupBy('status')
            ->get();
            return ApiResponse::data(['Attendance'=>$Attendance]);
    }

    public function getAttendanceReport(Request $request)
    {
        $request->validate([
            'class_id'   => 'required|exists:classes,id',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        $class_id   = $request->class_id;
        $start_date = $request->start_date;
        $end_date   = $request->end_date;

        if ($this->user_role === 'teacher' && ! $this->classBelongsToTeacher($this->user_id, $class_id)) {
            return ApiResponse::errors('Unauthorized', 403);
        }

        return ApiResponse::data($this->generateAttendanceReport($class_id, $start_date, $end_date));
    }

    private function generateAttendanceReport($class_id, $start_date, $end_date)
    {
        $dailyTrends = Attendance::selectRaw('DATE(date) as date, COUNT(*) as total_students,
                SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) as present_count,
                SUM(CASE WHEN status = "absent" THEN 1 ELSE 0 END) as absent_count,
                SUM(CASE WHEN status = "late" THEN 1 ELSE 0 END) as late_count')
            ->where('class_id', $class_id)
            ->whereBetween('date', [$start_date, $end_date])
            ->groupBy(DB::raw('DATE(date)'))
            ->orderBy('date')
            ->get();

        $mostAbsentStudent = Attendance::select('student_id', DB::raw('COUNT(*) as total_absences'))
            ->where('class_id', $class_id)
            ->whereBetween('date', [$start_date, $end_date])
            ->where('status', 'absent')
            ->groupBy('student_id')
            ->orderByDesc('total_absences')
            ->limit(1)
            ->with('student:id,name')
            ->first();

        return ApiResponse::data(['daily_trends' => $dailyTrends, 'most_absent_student' => $mostAbsentStudent]);

    }

}
