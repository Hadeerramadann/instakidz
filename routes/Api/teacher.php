
<?php
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/teacher','namespace' => 'Api\teacher'], function () {


   Route::post('attendance/mark', 'AttendanceController@markStudentAttendance');
  
   

   
});
